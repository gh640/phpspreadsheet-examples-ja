<?php

/**
 * @file
 * xlsx ファイルの中身をイテレータを使って全セル読み込みます。
 */

$root = dirname(__DIR__);

require $root . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$file_in = $root . '/examples/data/read-with-iterator.xlsx';

read_xlsx($file_in);

function read_xlsx(string $file) {
  $reader = IOFactory::createReader('Xlsx');
  $reader->setReadDataOnly(true);
  $spreadsheet = $reader->load($file);
  $ws = $spreadsheet->getActiveSheet();

  foreach ($ws->getRowIterator() as $row) {
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);

    foreach ($cellIterator as $cell) {
      $value = $cell->getValue();
      printf('%s (%s) ', $value, gettype($value));
    }
    print(PHP_EOL);
  }
}
