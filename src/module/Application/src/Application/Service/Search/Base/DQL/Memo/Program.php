<?php

namespace Application\Service\Search\Base\DQL\Memo;

use Application\Service\Search\Base\DQL\Memo;

/**
 * Class Subscription.
 */
class Program extends Memo
{
    const PRIVILEGE = 'program';
    /**
     * Returns an identifying name for this type of search
     * (so pages with multiple paginated data sets can generate events
     * about this data set being updated/modified).
     *
     * @return string
     */
    public function getResultTag()
    {
        return 'program_memo';
    }

    /**
     * This function is used by the class to get
     * the entity's repository to be returned.
     *
     * @return mixed
     */
    protected function getRepository()
    {
        return 'Application\Entity\Base\Program\Memo';
    }
}
