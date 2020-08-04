<?php

/**
 * @file
 * ファイルのタイプを自動的に認識するモード
 */

$root = dirname(__DIR__);

require $root . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

$file_in = $root . '/examples/data/read-tsv.tsv';

dump_rows(read_tsv($file_in));

function read_tsv(string $file) {
  $reader = new Csv();
  $reader->setDelimiter("\t");
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
