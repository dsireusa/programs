<?php

namespace Application\Service\Cli\Export;

use Application\Util\Export\ExportInterface;
use FzyCommon\Util\Params;
use Zend\Db\Adapter\Adapter;
use Application\Service\Cli\Base as CliBaseService;

/**
 * Class Base.
 */
class Base extends CliBaseService
{
    /**
     * The number of rows to pull back per query.
     */
    const QUERY_WINDOW_SIZE = 500;

    public function export(ExportInterface $exporter, Params $exportConfig)
    {
        $config = $this->getConfig()->getWrapped('doctrine')->getWrapped('connection')->getWrapped('orm_default')->getWrapped('params');
        // connect to doctrine db
        $db = new \Zend\Db\Adapter\Adapter(array(
            'driver' => 'Mysqli',
            'database' => $config->get('dbname'),
            'username' => $config->get('user'),
            'password' => $config->get('password'),
            'hostname' => $config->get('host'),
            'port' => $config->get('port'),
            'charset' => 'UTF8',
        ));
        $this->output('iterating tables');
        $tables = $db->query('SHOW TABLES')->execute();
        $tableNames = new Params();
        $exclude = $exportConfig->get('exclude', array());
        foreach ($tables as $table) {
            $tableName = $table['Tables_in_'.$config->get('dbname')];
            if (in_array($tableName, $exclude)) {
                $this->output("Excluding $tableName due to configuration.");
                continue;
            }
            $tableNames->set($tableName, Params::create(array('table' => $tableName, 'fields' => new Params())));
        }

        return $this->processTables($db, $exporter, $exportConfig, $tableNames);
    }

    protected function processTables(Adapter $db, ExportInterface $exporter, Params $exportConfig, Params $tables)
    {
        $exporter->start($exportConfig);
        foreach ($tables->get() as $tableName => $tableData) {
            $this->output("=== Start Exporting: $tableName ===");
            $exporter->startTable($tableName, $exportConfig);
            $this->processTable($db, $exporter, $exportConfig, $tableName, $tableData);
            $exporter->endTable($tableName, $exportConfig);
            $this->output("=== End Exporting: $tableName ===");
        }
        $exporter->end($exportConfig);

        return $this;
    }

    protected function processTable(Adapter $db, ExportInterface $exporter, Params $exportConfig, $tableName, Params $tableData)
    {
        $index = 0;
        $result = $db->query('SELECT COUNT(*) as total FROM '.$tableName)->execute()->current();
        $total = $result['total'];
        while ($index < $total) {
            $results = $db->query('SELECT * FROM '.$tableName.' LIMIT ?,?')->execute(array($index, self::QUERY_WINDOW_SIZE));
            foreach ($results as $result) {
                $exporter->row(Params::create($result), $exportConfig);
                ++$index;
            }
        }
    }
}
