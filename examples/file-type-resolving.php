<?php

/**
 * @file
 * ファイルのタイプを自動的に認識するモード
 */

$root = dirname(__DIR__);

require $root . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$file_in_tsv = $root . '/examples/data/file-type-resolving.tsv';
$file_in_xlsx = $root . '/examples/data/file-type-resolving.xlsx';

dump_rows($file_in_tsv, read_tsv($file_in_tsv));
dump_rows($file_in_xlsx, read_tsv($file_in_xlsx));

function read_tsv(string $file) {
  $reader = IOFactory::createReaderForFile($file);

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

function dump_rows(string $title, array $rows) {
  print($title . ':' . PHP_EOL);

  foreach ($rows as $row) {
    foreach ($row as $cell) {
      printf("%s\t", $cell);
    }
    print(PHP_EOL);
  }
}
