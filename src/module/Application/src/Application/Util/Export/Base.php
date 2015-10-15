<?php

namespace Application\Util\Export;

use Application\Entity\Base\Export;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class Base.
 */
abstract class Base implements ExportInterface
{
    const EXPORT_TYPE = 'default';
    const EXPORT_KEY_PREFIX = 'fullexports/';
    /**
     * @var ServiceLocatorInterface
     */
    protected $sm;

    public function setServiceLocator(ServiceLocatorInterface $sm)
    {
        $this->sm = $sm;

        return $this;
    }

    /**
     * @return ServiceLocatorInterface
     */
    protected function getServiceLocator()
    {
        return $this->sm;
    }

    public function __construct(ServiceLocatorInterface $sm)
    {
        $this->setServiceLocator($sm);
    }

    protected function uploadFileToKey($fileName, $key)
    {
        /* @var $s3 \Aws\S3\S3Client */
        $s3 = $this->getServiceLocator()->get('FzyCommon\Service\Aws\S3');
        $bucket = $this->getServiceLocator()->get('FzyCommon\Service\Aws\S3\Config')->get('bucket');
        $s3->putObject(array(
            'Bucket' => $bucket,
            'Key' => $key,
            'SourceFile' => $fileName,
            'ACL' => 'public-read',
        ));
        $s3->waitUntilObjectExists(array(
            'Bucket' => $bucket,
            'Key' => $key,
        ));
        $export = new Export();
        $export->setKey($key)->setCreatedTs('now')->setType(static::EXPORT_TYPE)->setSize(filesize($fileName));
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $em->persist($export);
        $em->flush();

        return $this;
    }
}
