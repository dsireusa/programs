<?php

namespace Application\Util\Export;

use FzyCommon\Util\Params;
use Zend\ServiceManager\ServiceLocatorInterface;

interface ExportInterface
{
    public function setServiceLocator(ServiceLocatorInterface $sm);

    public function start(Params $exportConfig);

    public function startTable($tableName, Params $exportConfig);

    public function row(Params $data, Params $exportConfig);

    public function endTable($tableName, Params $exportConfig);

    public function end(Params $exportConfig);
}
