<?php

// リクエストされたURIのパスを取得
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// $document_root = __DIR__ . '/public'; // 静的ファイルが置かれているディレクトリ
$document_root = __DIR__ . '/../'; // 静的ファイルが置かれているディレクトリ

// デバッグログの出力
// error_log("Request URI: " . $uri);
// error_log("Document Root: " . $document_root);

// 静的ファイルのフルパスを構築
$file_path = $document_root . $uri;
// error_log("Request URI: " . $file_path);

// 静的ファイルが実際に存在するか、かつディレクトリではないかをチェック
if (is_file($file_path) && !is_dir($file_path)) {
    // 存在する場合は、ビルトインサーバーに直接配信させる
    // return false; を返すことで、PHPビルトインサーバーがそのファイルを配信する
    // error_log("file found, distributing from built-in server: " . $file_path);
    return false;
}

// 静的ファイルではない場合、Functions Frameworkのルーターに処理を移す
// vendors/autoload.php を読み込んでから、Functions Frameworkのルーターを読み込む
require __DIR__ . '/../vendor/autoload.php';

// Functions Frameworkのrouter.phpに処理を渡す
require_once __DIR__ . '/../vendor/google/cloud-functions-framework/router.php';
