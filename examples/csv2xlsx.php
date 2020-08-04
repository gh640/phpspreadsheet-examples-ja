<?php

/**
 * @file
 * csv ファイルの内容を xlsx ファイルに移して保存します。
 */

$root = dirname(__DIR__);

require $root . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$file_in = $root . '/examples/data/csv2xlsx.csv';
$file_out = $root . '/out/csv2xlsx.xlsx';

$rows = read_csv($file_in);
write_xlsx($file_out, $rows);

function read_csv(string $file) {
  $rows = [];
  if (($handle = fopen($file, 'r')) !== FALSE) {
    while (($row = fgetcsv($handle)) !== FALSE) {
      $rows[] = $row;
    }

    fclose($handle);
  }

  return $rows;
}

function write_xlsx(string $file, array $rows) {
  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();

  for ($i = 0; $i < count($rows); $i++) {
    $row = $rows[$i];
    for ($j = 0; $j < count($row); $j++) {
      // Paramaters are column, row and value.
      $sheet->setCellValueByColumnAndRow($j + 1, $i + 1, $row[$j]);
    }
  }

  $writer = new Xlsx($spreadsheet);
  $writer->save($file);

  printf('File %s is saved.' . PHP_EOL, $file);
}
