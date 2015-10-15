<?php

namespace Application\Service\Search\Base;

use FzyCommon\Exception\Search\NotFound as NotFoundException;
use FzyCommon\Entity\BaseInterface;
use FzyCommon\Service\Search\Base;
use FzyCommon\Service\Search\Param;
use FzyCommon\Util\Params;

/**
 * Class Export.
 */
class Export extends Base
{
    /**
     * @var bool
     */
    protected $more;

    /**
     * This function should return the value of
     * the param name used to identify this search class' repository.
     *
     * Eg: if this is a User subclass, $this->getIdParam() ought to return 'userId'
     * so the param array can check if 'userId' was set and therefore
     * indicate a lookup rather than a general search
     *
     * @return mixed
     */
    protected function getIdParam()
    {
        return 'key';
    }

    /**
     * Performs a query based on the params for a collection
     * of objects to be returned. This function ought to
     * set the $total value.
     *
     * @param Param $params
     *
     * @return array|\Traversable
     */
    protected function querySearch(Params $params)
    {
        // return an array of keys in the prefix
        $query = Params::create(array(
            'Bucket' => $this->getBucket(),
            'MaxKeys' => $this->getLimit() + 1,
            'Prefix' => \Application\Util\Export\Base::EXPORT_KEY_PREFIX,
        ));
        if ($marker = trim($params->get('after'))) {
            $query->set('Marker', $marker);
        }
        /* @var $results \Guzzle\Service\Resource\Model */
        $results = $this->getS3()->listObjects($query->get())->get('Contents');
        if (empty($results)) {
            $results = array();
        }
        $this->more = false;
        if (count($results) > $this->getLimit()) {
            $this->more = true;
            array_pop($results);
        }
        $this->total = count($results) + ($this->more ? 1 : 0);

        return $results;
    }

    /**
     * @param $entity
     * @param Params             $params
     * @param array|\Traversable $results
     * @param bool               $asEntity
     *
     * @return array
     */
    protected function process($entity, Params $params, $results, $asEntity = false)
    {
        $key = $entity['Key'];

        return array(
            'key' => $key,
            'type' => $key == \Application\Util\Export\Base::EXPORT_KEY_PREFIX ? 'directory' : 'file',
            'url' => $this->url()->fromS3($key),
            'size' => $entity['Size'],
        );
    }

    /**
     * Finds an element in this domain which has the specified ID.
     *
     * @param $id
     *
     * @return BaseInterface
     *
     * @throws \FzyCommon\Exception\Search\NotFound
     */
    public function find($id)
    {
        if (!$this->getS3()->doesObjectExist($this->getBucket(), $id)) {
            throw new NotFoundException("No export with the key $id", 404);
        }

        return $id;
    }

    /**
     * Returns an identifying name for this type of search
     * (so pages with multiple paginated data sets can generate events
     * about this data set being updated/modified).
     *
     * @return string
     */
    public function getResultTag()
    {
        return 'exports';
    }

    /**
     * @return string
     */
    protected function getBucket()
    {
        return $this->getServiceLocator()->get('FzyCommon\Service\Aws\S3\Config')->get('bucket');
    }

    /**
     * @return \Aws\S3\S3Client
     */
    protected function getS3()
    {
        return $this->getServiceLocator()->get('FzyCommon\Service\Aws\S3');
    }
}
