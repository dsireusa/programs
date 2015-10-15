<?php

namespace Application\Service\Update;

use Application\Entity\Base\ProgramInterface;
use FzyCommon\Util\Params;

/**
 * Class Program.
 */
abstract class Program extends Base
{
    const MAIN_TAG = 'program';

    const MAIN_ENTITY_CLASS = 'Application\Entity\Base\Program';

    const MAIN_ENTITY_ID_PARAM = 'programId';

    protected function setUpFormDataEventListeners()
    {
        $this->formDataEvent(static::MAIN_TAG, array($this, 'handleProgramFormData'));
    }

    /**
     * @param Params $params
     *
     * @return Params
     *
     * @throws \Application\Exception\Service\Update\FailedTimeConversion
     */
    protected function handleProgramFormData(Params $params)
    {
        $this->formatDateData($params, 'startDate')->formatDateData($params, 'endDate');

        return $params;
    }

    /**
     * Based on the program, get the next 'code'
     * Program code logic:.
     *
     * (State abbreviation) + (incremental 0 padded number) + (F or R depending on the program category)
     * The incremental number is determined by the next number for the series of other codes with the same prefix and suffix.
     *
     * @param ProgramInterface $program
     *
     * @return string
     */
    protected function generateProgramCode(ProgramInterface $program)
    {
        $state = $program->getState()->getAbbreviation();
        $typeName = $program->getCategory()->getName();
        $type = $typeName{0};
        $next = 0;
        try {
            $next = $this->em()->createQuery("SELECT MAX(SUBSTRING(TRIM(TRAILING '{$type}' FROM p.code), 3)) FROM Application\Entity\Base\Program p WHERE p.state = :state AND p.category = :category")->setParameters(array(
                'state' => $program->getState()->id(),
                'category' => $program->getCategory()->id(),
            ))->getSingleScalarResult();
        } catch (\Exception $e) {
            var_dump(get_class($e));
        }

        return $state.str_pad(intval($next) + 1, 2, '0', STR_PAD_LEFT).$type;
    }

    /**
     * Returns the route name to redirect to on successful update.
     *
     * @return string
     */
    public function getSuccessRedirectRouteName()
    {
        return 'home/system/program';
    }
}
