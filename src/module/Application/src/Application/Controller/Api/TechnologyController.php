<?php

namespace Application\Controller\Api;

class TechnologyController extends AbstractApiController
{
    /**
     * @return mixed
     */
    protected function getSearchServiceKey()
    {
        return 'technologies';
    }

    /**
     * @return mixed
     */
    protected function getUpdateServiceKey()
    {
        return 'technology';
    }
}
