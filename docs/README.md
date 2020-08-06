# PhpSpreadsheet サンプル

Composer パッケージ `phpoffice/phpspreadsheet` の使用サンプルです。

- [GitHub - PHPOffice/PhpSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet)
- [PhpSpreadsheet Documentation](https://phpspreadsheet.readthedocs.io/en/latest/)

`phpoffice/phpspreadsheet` の `1.x` を使用しています。

すぐにコードを試せるように Docker の設定を同梱しています。

## 準備

1. リポジトリをクローンします
2. Docker イメージをビルドします

```bash
$ cd phpspreadsheet-examples-ja/
$ docker-compose build
```

## 使い方

`examples/` 以下にある `.php` ファイルを `docker-compose.yml` で定義されている `php` コンテナで実行します。

```bash
$ docker-compose run --rm php php examples/hello-world.php
```
