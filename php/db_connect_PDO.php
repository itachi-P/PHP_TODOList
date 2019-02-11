<?php
//echo phpinfo();
//DB接続サンプル1 - PDO(PHP Data Objects)利用(PHP5.5以降の推奨)
//DBの種類による差異をPDOが吸収してくれる為、DB種類毎にソースコードを書き換える必要がない
try {
	$pdo = new PDO('mysql: host=localhost; dbname=shino; charset=utf8', 'user1', 'pass1')
    ;
} catch ( PDOException $e ) {
    echo "接続エラー:".mb_convert_encoding($e->getMessage(), 'utf-8', 'Shift-JIS');
}
$stmt = $pdo->query('select * from todolist');
?>
<html>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>MySQL接続サンプル1(PDO)</title>
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

//INSERT (doneにはテーブル定義のデフォルト値'未'が入る)
$stmt = $pdo -> prepare("INSERT INTO todolist (subject, staff, term) 
										VALUES (:subject, :staff, :term)");
$stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
$stmt->bindValue(':staff', 'Alubomulle Sumanasara', PDO::PARAM_STR);
$stmt->bindValue(':term', date('Y/m/d', strtotime('+1 month')), PDO::PARAM_STR);
$subject = '書類整理'.rand(01, 10);
$stmt->execute();

// UPDATE
$sql = 'UPDATE todolist SET done = :done WHERE id = :id';
$stmt = $pdo -> prepare($sql);
$stmt->bindParam(':done', $done, PDO::PARAM_STR);
$stmt->bindValue(':id', 6, PDO::PARAM_INT);
$done = date('Y/m/d');
$stmt->execute();

//DELETE
$sql = 'DELETE FROM todolist WHERE subject LIKE :delete_subject';
$stmt = $pdo -> prepare($sql);
$stmt -> bindParam(':delete_subject', $subject, PDO::PARAM_STR);
$subject = '項目1%';
$stmt -> execute();

?>
	</table>
</body>
