<?php

/**
 * @file
 * SJIS エンコーディングの dsv を書き込む
 */

$root = dirname(__DIR__);

require $root . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

$file_out = $root . '/out/write-dsv-sjis.csv';

$rows = [
  ['こめ', '米', null],
  ['ぱん', 'パン', ''],
  ['なん', 'ナン', 'なんなん'],
  ['ぽてと', 'ポテイトゥ', 'potatoes'],
];

dump_rows($rows);
write_sjis_csv($file_out, 'SJIS-win', $rows);

function write_sjis_csv(string $file, string $encoding, array $rows) {
  $spreadsheet = new Spreadsheet();
  $ws = $spreadsheet->getActiveSheet();

  for ($i = 0; $i < count($rows); $i++) {
    $row = $rows[$i];
    for ($j = 0; $j < count($row); $j++) {
      // Paramaters are column, row and value.
      $ws->setCellValueByColumnAndRow($j + 1, $i + 1, $row[$j]);
    }
  }

  $writer = new Csv($spreadsheet);
  $writer->setDelimiter(',');
  $writer->save($file);

  // `Reader\Csv` にある `setInputEncoding()` の output 版は無いので
  // ファイルを書き出した後に書き換える必要あり
  // convert_file_encoding($file, $encoding);
  convert_file_encoding_stream($file, $encoding);
  printf('File %s saved with %s.' . PHP_EOL, $file, $encoding);
}

/**
 * ファイルのエンコーディングを `file_get_contents()` で変換する
 */
function convert_file_encoding(string $file, string $encoding) {
  $raw = file_get_contents($file);
  $converted = mb_convert_encoding($raw, $encoding, 'UTF-8');
  file_put_contents($file, $converted);
}

/**
 * ファイルのエンコーディングを stream を使って変換する
 */
function convert_file_encoding_stream(string $file, string $encoding) {
  $temp = fopen('php://temp', 'r+b');

  if ($handle = fopen($file, 'rb')) {
    stream_copy_to_stream($handle, $temp);
    fclose($handle);
    rewind($temp);
  }

  if ($handle = fopen($file, 'wb')) {
    while (!feof($temp)) {
      fwrite($handle, mb_convert_encoding(fread($temp, 8192), $encoding, 'UTF-8'));
    }
    fclose($handle);
  }
}

function dump_rows(array $rows) {
  foreach ($rows as $row) {
    foreach ($row as $cell) {
      printf("%s\t", $cell);
    }
    print(PHP_EOL);
  }
}
