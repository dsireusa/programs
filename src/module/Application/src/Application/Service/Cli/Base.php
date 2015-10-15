<?php

namespace Application\Service\Cli;

use Zend\Log\Logger;
use Zend\Log\Writer\Stream;

class Base extends \Application\Service\Base
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @return Logger
     */
    public function getLogger()
    {
        if (!isset($this->logger)) {
            $logger = new Logger();
            $logger->addWriter(new Stream('php://output'));
            $this->logger = $logger;
        }

        return $this->logger;
    }

    /**
     * @param Logger $logger
     *
     * @return Base
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;

        return $this;
    }

    protected function output($text)
    {
        $this->getLogger()->debug($text);

        return $this;
    }
}
