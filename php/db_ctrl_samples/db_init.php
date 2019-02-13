<?php

//初期化以外に分岐がない場合は不要だが、後のコード再利用の為に記述
if (isset($_POST['init'])) {

	// ※非推奨 SQL文やCSVファイル等のデータ読み込みは重大なセキュリティホールになりうるので基本的に避けるべき
	// サーバー上には置かずにローカルのファイルを読み込む場合もネット上に公開する以上は危険
	// 変数に代入する形でSQL文を記述した.phpファイルをrequireする方が安全？
	$sql = file_get_contents('../../SQL/table_reset.sql');
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
header("location:".$url, true, 301);
// 全ての出力を終了
exit();
?>