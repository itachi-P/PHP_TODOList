<?php
//echo phpinfo();
//DB接続サンプル1 - PDO(PHP Data Objects)利用(PHP5.5以降の推奨)
//DBの種類による差異をPDOが吸収してくれる為、DB種類毎にソースコードを書き換える必要がない
try {
	$pdo = new PDO('mysql:host=localhost;dbname=goods;charset=utf8','user1','pass1')
    ;
} catch ( PDOException $e ) {
    echo "接続エラー:".mb_convert_encoding($e->getMessage(), 'utf-8', 'Shift-JIS');
}
$stmt = $pdo->query('select * from goods_table');
?>
<html>
<body>
	<table>
<?php
while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
	$id = $row["id"];
	$name = $row["name"];
	//$gender = $row["gender"];
	$price = $row["price"];
	//$cost = $row["cost"];
?>
		<tr>
			<td><?= $id."</td><td>".$name."</td><td>".$price ?></td>
		</tr>
<?php	
}

//INSERT
$stmt = $pdo -> prepare("INSERT INTO goods_table(name, gender, price, cost) VALUES (:name, :gender, :price, :cost)");
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':gender', 2, PDO::PARAM_INT);
$stmt->bindValue(':price', 12000, PDO::PARAM_INT);
$stmt->bindValue(':cost', 4000, PDO::PARAM_INT);
$name = '着ぐるみ'.rand(01, 10);
$stmt->execute();

// UPDATE
$sql = 'UPDATE goods_table SET name =:name WHERE id = :id';
$stmt = $pdo -> prepare($sql);
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':id', 46, PDO::PARAM_INT);
$stmt->execute();

//DELETE
$sql = 'DELETE FROM goods_table WHERE id > :delete_id';
$stmt = $pdo -> prepare($sql);
$stmt -> bindParam(':delete_id', $id, PDO::PARAM_INT);
$id = 50;
$stmt -> execute();

?>
	</table>
</body>
