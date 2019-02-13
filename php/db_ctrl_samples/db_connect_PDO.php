<?php
//echo phpinfo();

//DB接続サンプル1 - PDO(PHP Data Objects)利用(PHP5.5以降の推奨)
//DBの種類による差異をPDOが吸収してくれる為、DB種類毎にソースコードを書き換える必要がない
try {
	//データベースハンドルの取得
	$pdo = new PDO('mysql:host=localhost; dbname=shino; charset=utf8mb4', 'user1', 'pass1');
	// エラーが発生した場合、例外がスローされるようにする(開発時向け)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
	// エラーメッセージの文字化け防止
    echo "接続エラー:".mb_convert_encoding($e->getMessage(), 'utf-8', 'Shift-JIS');
}
//クエリの実行(プリペアドステートメント→execute()を使う必要がない場合の直接的なやり方)
$stmt = $pdo->query('select * from todolist');
?>

<html>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>DB接続サンプル1(PDO)</title>
		<style type="text/css">
        table, td, th {
            border: solid black 1px;
        }
        table {
            width: 80%;
        }
    </style>
</head>
<body>
	<table style="border: solid 1px #777;">
<?php
while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
	$id = $row["id"];
	$subject = $row["subject"];
	$staff = $row["staff"];
	$term = $row["term"];
	$done = $row["done"];
?>
		<tr>
			<td><?= $id ?></td>
			<td><?= $subject ?></td>
			<td><?= $staff ?></td>
			<td><?= $term ?></td>
			<td><?= $done ?></td>
			<td>(仮)寒蜜徒釦ｓ</td>
		</tr>
<?php
}
?>
	</table>
</body>
