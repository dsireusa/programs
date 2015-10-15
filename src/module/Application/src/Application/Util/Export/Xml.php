<?php

namespace Application\Util\Export;

use Application\Entity\Base\ExportInterface;
use FzyCommon\Util\Params;

class Xml extends Base
{
    const EXPORT_TYPE = ExportInterface::TYPE_XML;
    /**
     * Absolute path to the temporary file for the CSV.
     *
     * @var string
     */
    protected $fileName;

    /**
     * Handle for the CSV file currently being modified.
     *
     * @var resource
     */
    protected $fileHandle;

    /**
     * Index of the row for the current table.
     *
     * @var int
     */
    protected $rowIndex;

    public function start(Params $exportConfig)
    {
        $this->fileName = tempnam($exportConfig->get('tmp-file-dir'), 'xml');
        $this->fileHandle = fopen($this->fileName, 'w');
        $this->writeLine('<?xml version="1.0" ?>')
            ->writeLine('<tables>');
    }

    public function startTable($tableName, Params $exportConfig)
    {
        $this->rowIndex = 0;
        $this->writeLine("\t".'<table name="'.$tableName.'">');
    }

    public function row(Params $data, Params $exportConfig)
    {
        $this->writeLine("\t\t<row index=\"{$this->rowIndex}\">");
        foreach ($data->get() as $colName => $value) {
            $this->writeLine("\t\t\t"."<column name=\"$colName\"><![CDATA[$value]]></column>");
        }
        $this->writeLine("\t\t</row>");
        ++$this->rowIndex;
    }

    public function endTable($tableName, Params $exportConfig)
    {
        $this->writeLine("\t".'</table>');
    }

    public function end(Params $exportConfig)
    {
        $this->writeLine('</tables>');
        fclose($this->fileHandle);

        return $this->uploadFileToKey($this->fileName, self::EXPORT_KEY_PREFIX.'dsire-'.date('Y-m').'.xml');
    }

    /**
     * @param $line
     *
     * @return $this
     */
    protected function writeLine($line)
    {
        fwrite($this->fileHandle, $line."\n");

        return $this;
    }
}
