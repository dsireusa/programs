<?php

namespace Application\Service\Update\Authority;

use Application\Service\Update\Base as UpdateService;
use FzyCommon\Util\Params;
use Rhumsaa\Uuid\Uuid;

class Upload extends UpdateService
{
    const FILE_PARAM_KEY = 'file';

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $fileName;

    /**
     * @var string
     */
    protected $bucket;

    /**
     * @var string
     */
    protected $url;

    public function update(Params $params, $options = array())
    {
        // get file
        $fileData = $this->getFileData($params);

        // generate key
        $this->key = $key = $this->getKey($fileData, $params);

        /* @var $s3 \Aws\S3\S3Client */
        $s3 = $this->getServiceLocator()->get('FzyCommon\Service\Aws\S3');
        // upload to s3
        $this->valid = true;
        $this->setUseSessionMessage(false);
        try {
            $bucket = $this->getBucket($fileData, $params);
            $response = $s3->putObject(array(
                'Bucket' => $bucket,
                'Key' => $key,
                'SourceFile' => $fileData->get('tmp_name'),
                'ACL' => 'public-read',
            ));
            $s3->waitUntilObjectExists(array(
                'Bucket' => $bucket,
                'Key' => $key,
            ));
            $this->url = $s3->getObjectUrl($bucket, $key);
        } catch (\Exception $e) {
            $this->valid = false;
            $this->setErrorMessages(array(
                'x' => $e->getMessage(),
            ));
        }
    }

    /**
     * @return array
     */
    public function getEntitiesAsJson()
    {
        return array(
            'upload' => array(
                'fileName' => $this->fileName,
                'key' => $this->key,
                'bucket' => $this->bucket,
                'url' => $this->url,
            ),
        );
    }

    /**
     * @param Params $params
     *
     * @return Params
     */
    public function getFileData(Params $params)
    {
        return $params->getWrapped(static::FILE_PARAM_KEY);
    }

    /**
     * @param Params $fileData
     * @param Params $params
     *
     * @return string
     */
    public function getKey(Params $fileData, Params $params)
    {
        $this->fileName = $fileName = $fileData->get('name', '');
        $namePieces = explode('.', $fileName);
        $extension = count($namePieces) > 1 ? ('.'.end($namePieces)) : '';
        // generate a key
        return implode('/', array_filter(array('uploads', 'programs', $params->get('programId'), time(), Uuid::uuid4()))).$extension;
    }

    public function getBucket(Params $fileData, Params $params)
    {
        return isset($this->bucket) ? $this->bucket : ($this->bucket = $this->getServiceLocator()->get('FzyCommon\Service\Aws\S3\Config')->get('bucket'));
    }
}
