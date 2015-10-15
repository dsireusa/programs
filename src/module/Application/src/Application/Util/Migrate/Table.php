<?php

namespace Application\Util\Migrate;

use Application\Exception\Migrate\InvalidHook;
use Application\Exception\Migrate\ParameterMismatch;
use FzyCommon\Util\Params;
use Zend\Db\Adapter\Adapter;
use Zend\Log\Logger;

class Table
{
    const CHAR_REPLACE = <<<'END'
/
  (
    (?: [\x00-\x7F]               # single-byte sequences   0xxxxxxx
    |   [\xC0-\xDF][\x80-\xBF]    # double-byte sequences   110xxxxx 10xxxxxx
    |   [\xE0-\xEF][\x80-\xBF]{2} # triple-byte sequences   1110xxxx 10xxxxxx * 2
    |   [\xF0-\xF7][\x80-\xBF]{3} # quadruple-byte sequence 11110xxx 10xxxxxx * 3
    ){1,100}                      # ...one or more times
  )
| ( [\x80-\xBF] )                 # invalid byte in range 10000000 - 10111111
| ( [\xC0-\xFF] )                 # invalid byte in range 11000000 - 11111111
/x
END;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var Params
     */
    protected $options;
    /**
     * @var string
     */
    protected $sourceTableName;

    /**
     * @var array
     */
    protected $sourceFields;

    /**
     * @var string
     */
    protected $destinationTableName;

    /**
     * @var array
     */
    protected $destinationFields;

    /**
     * @var Callable
     */
    protected $setupFn;

    /**
     * @var Callable
     */
    protected $countTotalFn;

    /**
     * @var Callable
     */
    protected $postCountFn;

    /**
     * @var Callable
     */
    protected $continueCycleFn;

    /**
     * @var Callable
     */
    protected $cycleStartFn;

    /**
     * @var Callable
     */
    protected $selectQueryFn;

    /**
     * @var Callable
     */
    protected $preInsertFn;

    /**
     * @var Callable
     */
    protected $insertQueryFn;

    /**
     * @var Callable
     */
    protected $insertSuccessFn;

    /**
     * @var Callable
     */
    protected $onInsertSuccessFn;

    /**
     * @var Callable
     */
    protected $postInsertFn;

    /**
     * @var Callable
     */
    protected $cycleEndFn;

    /**
     * @var Callable
     */
    protected $teardownFn;

    public function __construct($sourceTableName, $destinationTableName, array $sourceFields = null, array $destinationFields = null)
    {
        $this->sourceTableName = $sourceTableName;
        $this->destinationTableName = $destinationTableName;
        $this->sourceFields = $sourceFields;
        $this->destinationFields = $destinationFields;
        $this->options = new Params();
    }

    /**
     * @return mixed
     */
    public function getSourceTableName()
    {
        return $this->sourceTableName;
    }

    /**
     * @param mixed $sourceTableName
     *
     * @return Table
     */
    public function setSourceTableName($sourceTableName)
    {
        $this->sourceTableName = $sourceTableName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSourceFields()
    {
        return $this->sourceFields;
    }

    /**
     * @param mixed $sourceFields
     *
     * @return Table
     */
    public function setSourceFields($sourceFields)
    {
        $this->sourceFields = $sourceFields;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDestinationFields()
    {
        return $this->destinationFields;
    }

    /**
     * @param mixed $destinationFields
     *
     * @return Table
     */
    public function setDestinationFields($destinationFields)
    {
        $this->destinationFields = $destinationFields;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDestinationTableName()
    {
        return $this->destinationTableName;
    }

    /**
     * @param mixed $destinationTableName
     *
     * @return Table
     */
    public function setDestinationTableName($destinationTableName)
    {
        $this->destinationTableName = $destinationTableName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCycleEndFn()
    {
        return $this->cycleEndFn;
    }

    /**
     * @param mixed $cycleEndFn
     *
     * @return Table
     */
    public function setCycleEndFn($cycleEndFn)
    {
        $this->cycleEndFn = $cycleEndFn;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCycleStartFn()
    {
        return $this->cycleStartFn;
    }

    /**
     * @param mixed $cycleStartFn
     *
     * @return Table
     */
    public function setCycleStartFn($cycleStartFn)
    {
        $this->cycleStartFn = $cycleStartFn;

        return $this;
    }

    /**
     * @return Callable
     */
    public function getContinueCycleFn()
    {
        return $this->continueCycleFn;
    }

    /**
     * @param Callable $continueCycleFn
     *
     * @return $this
     */
    public function setContinueCycleFn($continueCycleFn)
    {
        $this->continueCycleFn = $continueCycleFn;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInsertQueryFn()
    {
        return $this->insertQueryFn;
    }

    /**
     * @param mixed $insertQueryFn
     *
     * @return Table
     */
    public function setInsertQueryFn($insertQueryFn)
    {
        $this->insertQueryFn = $insertQueryFn;

        return $this;
    }

    /**
     * @return Callable
     */
    public function getCountTotalFn()
    {
        return $this->countTotalFn;
    }

    /**
     * @param Callable $countTotalFn
     *
     * @return $this
     */
    public function setCountTotalFn($countTotalFn)
    {
        $this->countTotalFn = $countTotalFn;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostCountFn()
    {
        return $this->postCountFn;
    }

    /**
     * @param mixed $postCountFn
     *
     * @return Table
     */
    public function setPostCountFn($postCountFn)
    {
        $this->postCountFn = $postCountFn;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostInsertFn()
    {
        return $this->postInsertFn;
    }

    /**
     * @param mixed $postInsertFn
     *
     * @return Table
     */
    public function setPostInsertFn($postInsertFn)
    {
        $this->postInsertFn = $postInsertFn;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPreInsertFn()
    {
        return $this->preInsertFn;
    }

    /**
     * @param mixed $preInsertFn
     *
     * @return Table
     */
    public function setPreInsertFn($preInsertFn)
    {
        $this->preInsertFn = $preInsertFn;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSelectQueryFn()
    {
        return $this->selectQueryFn;
    }

    /**
     * @param mixed $selectQueryFn
     *
     * @return Table
     */
    public function setSelectQueryFn($selectQueryFn)
    {
        $this->selectQueryFn = $selectQueryFn;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSetupFn()
    {
        return $this->setupFn;
    }

    /**
     * @param mixed $setupFn
     *
     * @return Table
     */
    public function setSetupFn($setupFn)
    {
        $this->setupFn = $setupFn;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTeardownFn()
    {
        return $this->teardownFn;
    }

    /**
     * @param mixed $teardownFn
     *
     * @return Table
     */
    public function setTeardownFn($teardownFn)
    {
        $this->teardownFn = $teardownFn;

        return $this;
    }

    /**
     * @param Params $params
     *
     * @return Table
     */
    public static function create(Params $params)
    {
        $table = new self($params->get('sourceTable'), $params->get('destinationTable'), $params->get('sourceFields', array()), $params->get('destinationFields', array()));
        $table->setSetupFn($params->get('setup', array($table, 'nullOp')))
            ->setCountTotalFn($params->get('countTotal', array($table, 'defaultCountTotalFn')))
            ->setPostCountFn($params->get('postCount', array($table, 'nullOp')))
            ->setContinueCycleFn($params->get('continueCycle', array($table, 'defaultContinueCycle')))
            ->setCycleStartFn($params->get('cycleStart', array($table, 'nullOp')))
            ->setSelectQueryFn($params->get('selectQuery', array($table, 'defaultSelectFn')))
            ->setPreInsertFn($params->get('preInsert', array($table, 'nullOp')))
            ->setInsertQueryFn($params->get('insert', array($table, 'defaultInsertFn')))
            ->setInsertSuccessFn($params->get('insertSuccess', array($table, 'defaultInsertSuccessFn')))
            ->setOnInsertSuccessFn($params->get('onInsertSuccess', array($table, 'nullOp')))
            ->setPostInsertFn($params->get('postInsert', array($table, 'nullOp')))
            ->setCycleEndFn($params->get('cycleEnd', array($table, 'nullOp')))
            ->setTeardownFn($params->get('teardown', array($table, 'nullOp')));

        return $table;
    }

    /**
     * Do nothing.
     */
    public function nullOp()
    {
    }

    public function defaultCountTotalFn(Table $self, Adapter $source, Adapter $destination)
    {
        $result = $source->query('SELECT COUNT(*) as count FROM '.$self->getSourceTableName())->execute()->current();

        return $result['count'];
    }

    public function defaultContinueCycle(Table $self, Adapter $source, Adapter $destination, $count, $offset, $limit)
    {
        return $offset < $count;
    }

    /**
     * Default behavior if not overridden by configuration to select data from source db.
     *
     * @param Table   $self
     * @param Adapter $source
     * @param Adapter $destination
     * @param $count
     * @param $offset
     * @param $limit
     *
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function defaultSelectFn(Table $self, Adapter $source, Adapter $destination, $count, $offset, $limit)
    {
        /* @var $result \Zend\Db\Adapter\Driver\Mysqli\Result */
        $result = $source->query('SELECT * FROM '.$self->getSourceTableName().' LIMIT ?,?')->execute(array($offset, $limit));
        $data = array();
        foreach ($result as $row) {
            $data[] = $row;
        }

        return $data;
    }

    /**
     * Default behavior if not overridden by configuration to insert source db data into destination table.
     *
     * @param Table   $self
     * @param Adapter $source
     * @param Adapter $destination
     * @param $count
     * @param $offset
     * @param $limit
     * @param Params $row
     * @param $index
     *
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function defaultInsertFn(Table $self, Adapter $source, Adapter $destination, $count, $offset, $limit, Params $row, $index)
    {
        $query = '';
        $params = array();
        try {
            $query = 'INSERT INTO '.$self->getDestinationTableName().' ('.implode(',', $self->getDestinationFields()).') VALUES (?'.str_repeat(',?', count($self->getDestinationFields()) - 1).')';
            $statement = $destination->query($query);
            foreach ($self->getSourceFields() as $key) {
                $paramValue = $row->get($key);
                if (!is_numeric($paramValue) && $paramValue) {
                    $paramValue = $this->sanitizeString($paramValue);
                }
                $params[] = $paramValue;
            }
            if (count($self->getDestinationFields()) != count($params)) {
                throw new ParameterMismatch('Destination table needs '.count($self->getDestinationFields()).' parameters but only '.count($params).' were provided');
            }

            return $statement->execute($params);
        } catch (\Exception $e) {
            // output some debug info.
            $this->getLogger()->debug("QUERY: $query");
            $this->getLogger()->debug('PARAMS:', $params);
            throw $e;
        }
    }

    public function wasProgramMigrated($programId, Adapter $destination, $log = true)
    {
        $result = $destination->query('SELECT id FROM program WHERE id = ?')->execute(array($programId))->current();
        if (empty($result)) {
            if ($log) {
                $this->getLogger()->debug("Program with id: $programId was not migrated.");
            }

            return false;
        }

        return true;
    }

    /**
     * @param Table $self
     * @param $result
     *
     * @return bool
     */
    public function defaultInsertSuccessFn(Table $self, $result)
    {
        return $result === true || ($result instanceof \Zend\Db\Adapter\Driver\Mysqli\Result && $result->getGeneratedValue());
    }

    /**
     * @param Adapter $source
     * @param Adapter $destination
     *
     * @return mixed
     *
     * @throws InvalidHook
     */
    public function setup(Adapter $source, Adapter $destination)
    {
        return $this->invoke($this->getSetupFn(), func_get_args());
    }

    /**
     * @param Adapter $source
     * @param Adapter $destination
     *
     * @return int
     *
     * @throws InvalidHook
     */
    public function countTotal(Adapter $source, Adapter $destination)
    {
        return $this->invoke($this->getCountTotalFn(), func_get_args());
    }

    /**
     * @param Adapter $source
     * @param Adapter $destination
     * @param $count
     *
     * @return mixed
     *
     * @throws InvalidHook
     */
    public function postCount(Adapter $source, Adapter $destination, $count)
    {
        return $this->invoke($this->getPostCountFn(), func_get_args());
    }

    /**
     * Returns whether the next cycle should be run.
     *
     * @param Adapter $source
     * @param Adapter $destination
     * @param $count
     * @param $offset
     * @param $limit
     *
     * @return bool
     *
     * @throws InvalidHook
     */
    public function continueCycle(Adapter $source, Adapter $destination, $count, $offset, $limit)
    {
        return $this->invoke($this->getContinueCycleFn(), func_get_args());
    }

    /**
     * @param Adapter $source
     * @param Adapter $destination
     * @param $count
     * @param $offset
     * @param $limit
     *
     * @return mixed
     *
     * @throws InvalidHook
     */
    public function cycleStart(Adapter $source, Adapter $destination, $count, $offset, $limit)
    {
        return $this->invoke($this->getCycleStartFn(), func_get_args());
    }

    /**
     * @param Adapter $source
     * @param Adapter $destination
     * @param $count
     * @param $offset
     * @param $limit
     *
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function selectQuery(Adapter $source, Adapter $destination, $count, $offset, $limit)
    {
        return $this->invoke($this->getSelectQueryFn(), func_get_args());
    }

    /**
     * @param Adapter $source
     * @param Adapter $destination
     * @param $count
     * @param $offset
     * @param $limit
     * @param $row
     *
     * @return mixed
     *
     * @throws InvalidHook
     */
    public function preInsert(Adapter $source, Adapter $destination, $count, $offset, $limit, Params $row, $index)
    {
        return $this->invoke($this->getPreInsertFn(), func_get_args());
    }

    /**
     * @param Adapter $source
     * @param Adapter $destination
     * @param $count
     * @param $offset
     * @param $limit
     * @param $row
     *
     * @return mixed
     *
     * @throws InvalidHook
     */
    public function insert(Adapter $source, Adapter $destination, $count, $offset, $limit, Params $row, $index)
    {
        return $this->invoke($this->getInsertQueryFn(), func_get_args());
    }

    public function insertSuccess($result)
    {
        return $this->invoke($this->getInsertSuccessFn(), func_get_args());
    }

    public function onInsertSuccess(Adapter $source, Adapter $destination, $count, $offset, $limit, Params $row, $index, $result)
    {
        return $this->invoke($this->getOnInsertSuccessFn(), func_get_args());
    }

    /**
     * @return Callable
     */
    public function getInsertSuccessFn()
    {
        return $this->insertSuccessFn;
    }

    /**
     * @param Callable $insertSuccessFn
     *
     * @return $this
     */
    public function setInsertSuccessFn($insertSuccessFn)
    {
        $this->insertSuccessFn = $insertSuccessFn;

        return $this;
    }

    /**
     * @return Callable
     */
    public function getOnInsertSuccessFn()
    {
        return $this->onInsertSuccessFn;
    }

    /**
     * @param Callable $onInsertSuccessFn
     *
     * @return $this
     */
    public function setOnInsertSuccessFn($onInsertSuccessFn)
    {
        $this->onInsertSuccessFn = $onInsertSuccessFn;

        return $this;
    }

    /**
     * @param Adapter $source
     * @param Adapter $destination
     * @param $count
     * @param $offset
     * @param $limit -
     * @param Params $row   - row data from the select query
     * @param int    $index - what iteration this insert is
     *
     * @return mixed
     *
     * @throws InvalidHook
     */
    public function postInsert(Adapter $source, Adapter $destination, $count, $offset, $limit, Params $row, $index)
    {
        return $this->invoke($this->getPostInsertFn(), func_get_args());
    }

    /**
     * @param Adapter $source
     * @param Adapter $destination
     * @param $count
     * @param $offset
     * @param $limit
     *
     * @return mixed
     *
     * @throws InvalidHook
     */
    public function cycleEnd(Adapter $source, Adapter $destination, $count, $offset, $limit)
    {
        return $this->invoke($this->getCycleEndFn(), func_get_args());
    }

    /**
     * @param Adapter $source
     * @param Adapter $destination
     *
     * @return mixed
     *
     * @throws InvalidHook
     */
    public function teardown(Adapter $source, Adapter $destination)
    {
        return $this->invoke($this->getTeardownFn(), func_get_args());
    }

    /**
     * @param $callable
     * @param array $args
     *
     * @return mixed
     *
     * @throws InvalidHook
     */
    protected function invoke($callable, array $args)
    {
        if (!is_callable($callable)) {
            throw new InvalidHook('The callable is invalid');
        }
        array_unshift($args, $this);

        return call_user_func_array($callable, $args);
    }

    /**
     * @return Params
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param Params $options
     *
     * @return Table
     */
    public function setOptions(Params $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return Logger
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param Logger $logger
     *
     * @return Table
     */
    public function setLogger(Logger $logger)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * Takes set of params and sanitizes any non-numeric values.
     *
     * @param Params $params
     * @param array  $keys
     *
     * @return $this
     */
    public function sanitizeParams(Params $params, $keys = array())
    {
        foreach ($params->get() as $key => $value) {
            if (!is_numeric($value) && (empty($keys) || in_array($key, $keys))) {
                $params->set($key, $this->sanitizeString($value));
            }
        }

        return $this;
    }

    /**
     * Returns string after attempts to sanitize.
     *
     * @param $text
     *
     * @return string
     */
    public function sanitizeString($text)
    {
        return iconv('utf-8', 'utf-8//ignore', preg_replace_callback(static::CHAR_REPLACE, array($this, 'utf8replacer'), $text));
    }

    protected function utf8replacer($captures)
    {
        if ($captures[1] != '') {
            // Valid byte sequence. Return unmodified.
            return $captures[1];
        } elseif ($captures[2] != '') {
            // Invalid byte of the form 10xxxxxx.
            // Encode as 11000010 10xxxxxx.
            return "\xC2".$captures[2];
        } else {
            // Invalid byte of the form 11xxxxxx.
            // Encode as 11000011 10xxxxxx.
            return "\xC3".chr(ord($captures[3]) - 64);
        }
    }
}
