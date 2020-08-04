# PhpSpreadsheet サンプル

Composer パッケージ `phpoffice/phpspreadsheet` の使用サンプルです。

- [GitHub - PHPOffice/PhpSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet)
- [PhpSpreadsheet Documentation](https://phpspreadsheet.readthedocs.io/en/latest/)

すぐにコードを試せるように Docker の設定を同梱しています。

## 使い方

`examples/` 以下にある `.php` ファイルを `docker-compose.yml` で定義されている `php` コンテナで実行します。

```bash
$ docker-compose run --rm php php examples/hello-world.php
```
