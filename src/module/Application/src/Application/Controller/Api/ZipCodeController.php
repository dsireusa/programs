<?php

namespace Application\Controller\Api;

class ZipCodeController extends AbstractApiController
{
    /**
     * @return mixed
     */
    protected function getSearchServiceKey()
    {
        return 'zip-codes';
    }

    /**
     * @return mixed
     */
    protected function getUpdateServiceKey()
    {
        throw new \RuntimeException('Zip Codes may not be updated');
    }
}
