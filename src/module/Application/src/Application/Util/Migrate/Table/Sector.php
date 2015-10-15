<?php

namespace Application\Util\Migrate\Table;

use Application\Util\Migrate\Table;
use FzyCommon\Util\Params;
use Zend\Db\Adapter\Adapter;

class Sector
{
    /**
     * @var Params
     */
    protected $config;

    public function __construct(array $config)
    {
        $this->config = Params::create($config);
    }

    public function process(Table $self, Adapter $destination, $parentId = null)
    {
        // insert into destination
        $result = $destination->query('INSERT INTO '.$self->getDestinationTableName().' (name, parent_id) VALUES (?, ?)')->execute(array($this->config->get('name'), $parentId));
        $sectorId = $result->getGeneratedValue();
        $childrenConfig = $this->config->getWrapped('children');
        $hasKids = false;
        foreach ($childrenConfig->get('new', array()) as $newChild) {
            $child = new self($newChild);
            $child->process($self, $destination, $sectorId);
            $hasKids = true;
        }
        foreach ($childrenConfig->get('lookup', array()) as $oldId) {
            $destination->query('UPDATE '.$self->getDestinationTableName().' SET parent_id = ? WHERE id = ?')->execute(array($sectorId, $oldId));
            $hasKids = true;
        }
        if ($hasKids) {
            $destination->query('UPDATE '.$self->getDestinationTableName().' SET is_selectable = 0 WHERE id = ?')->execute(array($sectorId));
        }

        return $this;
    }
}
