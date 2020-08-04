<?php

/**
 * @file
 * xlsx ファイルを作成します。
 */

$root = dirname(__DIR__);

require $root . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$file = $root . '/out/hello-world.xlsx';

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save($file);

printf('File %s is saved.' . PHP_EOL, $file);
