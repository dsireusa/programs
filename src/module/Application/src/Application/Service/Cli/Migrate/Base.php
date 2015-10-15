<?php

namespace Application\Service\Cli\Migrate;

use Application\Util\Migrate\Table;
use FzyCommon\Util\Params;
use Zend\Db\Adapter\Adapter;
use Zend\Console\Prompt;

class Base extends \Application\Service\Cli\Base
{
    /**
     * @var string|null
     */
    protected $table;

    public function migrate(Params $config)
    {
        $source = $this->getDbAdapter($config->getWrapped('source'));
        $dstConfig = $config->getWrapped('destination');
        $destination = $this->getDbAdapter($dstConfig);

        $express = false;

        // if no table specified, refresh entire db
        if (!$this->hasTable()) {
            /*
             * Skip all the prompts and:
             *  - start with clean schema
             *  - migrate each table
             *  - export migrated db to schema
             */
            $prompt = new Prompt\Confirm('Express? [y/n]', 'y', 'n');
            $express = $prompt->show();

            $confirm = new Prompt\Confirm('Start with clean database? [y/n]', 'y', 'n');
            if ($express || $confirm->show()) {
                // drop migrate db
                $source->query('DROP DATABASE IF EXISTS '.$dstConfig->get('database'), Adapter::QUERY_MODE_EXECUTE);
                // create migrate db
                $source->query('CREATE DATABASE '.$dstConfig->get('database'), Adapter::QUERY_MODE_EXECUTE);
                system('mysql -u'.$dstConfig->get('username').' -p'.$dstConfig->get('password').' '.$dstConfig->get('database').' < '.$config->get('schema'));
                // now create a dump without the data
                system('mysqldump -u'.$dstConfig->get('username').' -p'.$dstConfig->get('password').' --no-data '.$dstConfig->get('database')." | sed 's/ AUTO_INCREMENT=[0-9]*\b//' ".' > '.$config->get('schema'));
                // set that data-less db up
                system('mysql -u'.$dstConfig->get('username').' -p'.$dstConfig->get('password').' '.$dstConfig->get('database').' < '.$config->get('schema'));
                $this->getLogger()->debug('Fresh database installed');
            } else {
                $this->getLogger()->debug('Resuming with existing database.');
            }
        }

        foreach ($config->get('tables') as $tableConfig) {
            $table = Table::create(Params::create($tableConfig));
            $table->setLogger($this->getLogger());
            if ($this->hasTable()) {
                if ($this->getTable() != $table->getDestinationTableName()) {
                    continue;
                }
                // truncate database table
                $destination->query('set foreign_key_checks=0', Adapter::QUERY_MODE_EXECUTE);
                $destination->query('TRUNCATE TABLE '.$table->getDestinationTableName(), Adapter::QUERY_MODE_EXECUTE);
                $destination->query('set foreign_key_checks=1', Adapter::QUERY_MODE_EXECUTE);
            } else {
                $confirm = new Prompt\Confirm("Migrate Table {$table->getDestinationTableName()}? [y/n]", 'y', 'n');
                if (!$express && !$confirm->show()) {
                    $this->getLogger()->debug('Skipping Table '.$table->getDestinationTableName());
                    continue;
                }
            }
            // start migration process

            $this->getLogger()->debug("--== START Migrating {$table->getDestinationTableName()} ==--");
            $table->setup($source, $destination);
            // do count
            $count = $table->countTotal($source, $destination);
            $table->postCount($source, $destination, $count);
            $offset = 0;
            $limit = 100;
            $index = 0;
            $failed = 0;
            while ($table->continueCycle($source, $destination, $count, $offset, $limit)) {
                $table->cycleStart($source, $destination, $count, $offset, $limit);
                /* @var $data \Zend\Db\Adapter\Driver\Mysqli\Result */
                $data = $table->selectQuery($source, $destination, $count, $offset, $limit);
                foreach ($data as $row) {
                    $rowParams = Params::create($row);
                    $table->preInsert($source, $destination, $count, $offset, $limit, $rowParams, $index);
                    $result = $table->insert($source, $destination, $count, $offset, $limit, $rowParams, $index);
                    if (!$table->insertSuccess($result)) {
                        ++$failed;
                    } else {
                        $table->onInsertSuccess($source, $destination, $count, $offset, $limit, $rowParams, $index, $result);
                    }
                    $table->postInsert($source, $destination, $count, $offset, $limit, $rowParams, $index);
                    ++$index;
                }
                $table->cycleEnd($source, $destination, $count, $offset, $limit);
                $offset += $limit;
            }

            $table->teardown($source, $destination);
            if ($count === 0) {
                $count = $index;
            }
            $percentFailed = $count != 0 ? number_format($failed * 100 / $count, 2) : 0;
            $this->getLogger()->debug("Finished process, # failed inserts: $failed ({$percentFailed}% of {$count})}");
            $this->getLogger()->debug("--== END Migrating {$table->getDestinationTableName()} ==--");
        }
        if (!$this->hasTable()) {
            $prompt = new Prompt\Confirm('Would you like to export the migrated data to '.$config->get('schema').'? [y/n]');
            if ($express || $prompt->show()) {
                $this->getLogger()->debug('Exporting...');
                system('mysqldump -u'.$dstConfig->get('username').' -p'.$dstConfig->get('password').' '.$dstConfig->get('database').' > '.$config->get('schema'));
                $this->getLogger()->debug('Complete!');
            } else {
                $this->getLogger()->debug('Skipping db export.');
            }
        }
    }

    /**
     * @return bool
     */
    public function hasTable()
    {
        return !empty($this->table);
    }

    /**
     * @return null|string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param null|string $table
     *
     * @return $this
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * @param Params $params
     *
     * @return \Zend\Db\Adapter\Adapter
     */
    protected function getDbAdapter(Params $params)
    {
        return new \Zend\Db\Adapter\Adapter($params->get());
    }
}
