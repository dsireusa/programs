<?php

namespace Application\Service\Update;

use FzyCommon\Util\Params;

/**
 * Class Memo.
 */
class Memo extends Base
{
    const RESOURCE_NAME = 'Application\Service\Update\Memo';
    const PRIVILEGE_PROGRAM = 'program';
    const PRIVILEGE_SUBSCRIPTION = 'subscription';

    const MAIN_TAG = 'memo';

    const MAIN_ENTITY_CLASS = 'Application\Entity\Base\Program\City';

    const MAIN_ENTITY_ID_PARAM = 'memoId';

    /**
     * @var string
     */
    protected $type;

    /**
     * Creates a new instance of the entity this service updates.
     *
     * @param Params $params
     *
     * @return mixed
     */
    public function createNewEntity(Params $params)
    {
        $cls = null;
        switch ($this->type) {
            case self::PRIVILEGE_PROGRAM:
                $cls = 'Application\Entity\Base\Program\Memo';
                break;
            case self::PRIVILEGE_SUBSCRIPTION:
                $cls = 'Application\Entity\Base\Subscription\Memo';
                break;
            default:
                throw new \RuntimeException('Unable to create memo with type: '.$this->type);
        }
        $class = '\\'.$cls;
        $mainEntity = new $class();

        return $mainEntity;
    }
}
