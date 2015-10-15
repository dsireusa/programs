<?php

namespace Application\Util\Export;

use Application\Entity\Base\ExportInterface;
use FzyCommon\Util\Params;

class Csv extends Base
{
    const EXPORT_TYPE = ExportInterface::TYPE_CSV;
    /**
     * File name of the zip archive.
     *
     * @var string
     */
    protected $archiveFileName;
    /**
     * Reference to the zip archive.
     *
     * @var \ZipArchive
     */
    protected $archive;

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
     * Flag to indicate if this file has had headings added yet.
     *
     * @var bool
     */
    protected $headings = false;

    public function start(Params $exportConfig)
    {
        $this->archive = new \ZipArchive();
        $this->archiveFileName = tempnam($exportConfig->get('tmp-file-dir'), 'zip');
        if ($this->archive->open($this->archiveFileName, \ZipArchive::CREATE) !== true) {
            throw new \RuntimeException("Unable to open zip archive {$this->archiveFileName}");
        }
    }

    public function startTable($tableName, Params $exportConfig)
    {
        // create local tmp file
        // set 'current' table to new array
        $this->fileName = tempnam($exportConfig->get('tmp-file-dir'), $tableName);
        $this->fileHandle = fopen($this->fileName, 'w');
        $this->headings = false;
    }

    public function row(Params $params, Params $exportConfig)
    {
        if (!$this->headings) {
            // write the headings first off
            fputcsv($this->fileHandle, array_keys($params->get()));
            $this->headings = true;
        }
        // add row to current table array
        fputcsv($this->fileHandle, array_values($params->get()));
    }

    public function endTable($tableName, Params $exportConfig)
    {
        // export current table array to csv file in S3
        fclose($this->fileHandle);
        $this->archive->addFile($this->fileName, "$tableName.csv");
    }

    public function end(Params $exportConfig)
    {
        // zip up all csv files that have been generated
        $this->archive->close();
        // save to s3
        return $this->uploadFileToKey($this->archiveFileName, self::EXPORT_KEY_PREFIX.'dsire-'.date('Y-m').'.zip');
    }
}
