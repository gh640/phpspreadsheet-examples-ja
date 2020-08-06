<?php

/**
 * @file
 * SJIS エンコーディングの csv を読み込む
 */

$root = dirname(__DIR__);

require $root . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

$file_in_sjis = $root . '/examples/data/read-csv-sjis.csv';

dump_rows(read_sjis_tsv($file_in_sjis, 'SJIS-win'));

function read_sjis_tsv(string $file, string $encoding) {
  $reader = new Csv();
  $reader->setInputEncoding($encoding);
  $reader->setDelimiter(",");
  $reader->setSheetIndex(0);

  $spreadsheet = $reader->load($file);
  $ws = $spreadsheet->getActiveSheet();

  $rows = [];
  foreach ($ws->getRowIterator() as $row) {
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);

    $row = [];
    foreach ($cellIterator as $cell) {
      $row[] = $cell->getValue();
    }
    $rows[] = $row;
  }

  return $rows;
}

function dump_rows(array $rows) {
  foreach ($rows as $row) {
    foreach ($row as $cell) {
      printf("%s\t", $cell);
    }
    print(PHP_EOL);
  }
}
