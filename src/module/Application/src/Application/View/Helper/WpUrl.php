<?php

namespace Application\View\Helper;

use FzyCommon\View\Helper\Base;

/**
 * Class WpUrl.
 */
class WpUrl extends Base
{
    public function __invoke($path = null)
    {
        $url = $host = $this->getService('Application\WpConfig')->get('host');
        if ($path !== null) {
            if ($path{0} != '/') {
                $path = '/'.$path;
            }
            $url .= $path;
        }

        return $url;
    }
}
