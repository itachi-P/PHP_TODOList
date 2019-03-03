<?php
// あくまでもレコード1行の削除「確認」画面なので、基本的にはitem_idだけをdb_ctrl.phpにスルーパスするだけのワンクッションでよい

//session_start();
$item_id = $_POST['item_id'];

$dsn = 'mysql: host=127.0.0.1; dbname=shino; charset=utf8mb4';
$driver_options = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_EMULATE_PREPARES => false,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	];

try {
    $pdo = new PDO($dsn,'user1','pass1', $driver_options);

	$sql = "SELECT NAME AS item_name
			FROM TODO_ITEM
			WHERE ID = ".$item_id;
	// 結果は1行だけ(・・・の筈)なのでfetch()で可
    $row = $pdo->query($sql)->fetch();
    //print_r($row);

} catch (PDOException $e) {
	// エラー発生時に壊れたHTML画面ではなくプレーンテキストでエラーメッセージのみ表示
    header('Content-Type: text/plain; charset=UTF-8mb4', true, 500);
    exit($e->getMessage());
}

function hsc($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); //※mb4指定はエラー
}
$item_name = $row['item_name'];

$head_title = "削除確認画面";
$css_file = "regist.css";
require_once('header.tmp.php');
?>

<body>
	<h1>削除確認</h1>
	<div class="container">
		<form action="db_ctrl.php" method="POST">
			<h2>項目名　<b><?= hsc($item_name) ?></b>　を削除します。<br>
				よろしいですか？
			</h2>

			<div class="buttons-wrapper">
				<input type="hidden" name="item_id" value="<?=$item_id?>">
				<input class="btn" type="submit" value="削除" name="delete">
				<input class="btn" type="submit" value="キャンセル" name="cancel">
			</div> <!-- buttons-wrapper -->
		</form>
	</div> <!-- container -->
</body>
</html>
