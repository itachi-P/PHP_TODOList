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
$stmt = $pdo->query('select * from todolists');
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
            width: 600px;
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

//INSERT
$stmt = $pdo -> prepare("INSERT INTO todolists(subject, staff, term, done) VALUES (:subject, :staff, :term, :done)");
$stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
$stmt->bindValue(':staff', 'Sumanasara', PDO::PARAM_INT);
$stmt->bindValue(':term', '2020/04/15', PDO::PARAM_INT);
$stmt->bindValue(':done', '未', PDO::PARAM_INT);
$subject = '書類整理'.rand(01, 10);
$stmt->execute();

// UPDATE
$sql = 'UPDATE todolists SET subject =:subject WHERE id = :id';
$stmt = $pdo -> prepare($sql);
$stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
$stmt->bindValue(':id', 5, PDO::PARAM_INT);
$stmt->execute();

//DELETE
$sql = 'DELETE FROM todolists WHERE subject = :delete_subject';
$stmt = $pdo -> prepare($sql);
$stmt -> bindParam(':delete_subject', $subject, PDO::PARAM_INT);
$subject = '項目6';
$stmt -> execute();

?>
	</table>
</body>
