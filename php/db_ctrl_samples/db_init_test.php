<?php

//初期化以外に分岐がない場合は不要だが、後のコード再利用の為に記述
if (isset($_POST['init'])) {

	// ※非推奨 SQL文やCSVファイル等のデータ読み込みは重大なセキュリティホールになりうるので基本的に避けるべき
	// サーバー上には置かずにローカルのファイルを読み込む場合もネット上に公開する以上は危険
	// 変数に代入する形でSQL文を記述した.phpファイルをrequireする方が安全？
	$sql = file_get_contents('../../SQL/OLD_table_reset.sql');
	try {
		$dns = 'mysql:host=localhost; dbname=shino; charset=utf8mb4';
		$pdo = new PDO($dns, 'admin', 'admin');
		// 開発時向けにエラー発生時エラーログを表示
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->query($sql);
	} catch ( PDOException $e ) {
		echo mb_convert_encoding($e->getMessage(), 'utf-8', 'Shift-JIS');
	}
}

// 初期化が終わったら自動でリダイレクト
$url = "db_test_index.html";
/* header()によるリダイレクトの正しい利用法（ルール）
	1.header関数より前に一切の記述がないこと（<!DOCTYPE>宣言や<html>タグ、改行や空文字も不可）
	2.HTTPステータスコード301（Moved permanently 「恒久的移動」）の指定があること ※デフォルトは302（Found 「一時的な転送」）
		SEOの観点で検索エンジンに対し「リダイレクトの意図(ホームページの引越しなど殆どは301)」を明示する。
	3.リダイレクト実行後「exit;」を付記する（exit; でも exit(); でもどちらでもよい) */
header("location:".$url, true, 301);
// 全ての出力を終了
exit();
?>