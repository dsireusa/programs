<?php

namespace Application\Service\Update;

use Application\Exception\Service\Update\FailedTimeConversion;
use FzyCommon\Util\Params;

class Base extends \FzyForm\Service\Update\Base
{
    /**
     * @return \Application\Entity\Base\UserInterface
     */
    public function getCurrentUser()
    {
        return $this->getServiceLocator()->get('FzyAuth\CurrentUser');
    }

    public function formatDateData(Params $params,  $field)
    {
        if (trim($params->get($field))) {
            $value = $params->get($field);
            try {
                // assuming we're getting this time as EST
                $ts = new \DateTime($value, new \DateTimeZone('EST5EDT'));
                // convert to UTC
                $ts->setTimezone(new \DateTimeZone('UTC'));
                $params->set($field, $ts);
            } catch (\Exception $e) {
                throw new FailedTimeConversion('Unable to convert '.var_export($value, true).' into a date.', 0, $e);
            }
        }

        return $this;
    }
}
