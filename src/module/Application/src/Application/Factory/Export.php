<?php

namespace Application\Factory;

use Application\Util\Export\Csv;
use Application\Util\Export\Xml;
use Zend\ServiceManager\ServiceLocatorInterface;

class Export
{
    /**
     * @param $type
     *
     * @return \Application\Util\Export\ExportInterface
     */
    public function getExportUtil($type, ServiceLocatorInterface $sm)
    {
        switch ($type) {
            case 'csv':
                return new Csv($sm);
            case 'xml':
                return new Xml($sm);
        }
        throw new \RuntimeException('Invalid export type');
    }
}
