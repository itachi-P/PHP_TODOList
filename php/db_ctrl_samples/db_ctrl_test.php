<?php
$db_info = 'mysql: host=localhost; dbname=shino; charset=utf8';
try {
	//データベースハンドルの取得
	$pdo = new PDO($db_info, 'user1', 'pass1');
	//属性の設定 (開発時向けにエラー発生時エラーメッセージを画面表示するモードに設定)
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch ( PDOException $e ) {
    echo "接続エラー:".mb_convert_encoding($e->getMessage(), 'utf-8', 'Shift-JIS');
}

// INSERT (doneにはテーブル定義のデフォルト値'未'が入る)
$subject = '書類整理'.rand(01, 10);
$stmt = $pdo -> prepare("INSERT INTO todolist (subject, staff, term) 
								VALUES (:subject, :staff, :term)");
$stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
$stmt->bindValue(':staff', 'Alubomulle Sumanasara', PDO::PARAM_STR);
$stmt->bindValue(':term', date('Y/m/d', strtotime('+2 month')), PDO::PARAM_STR);
$stmt->execute();

// UPDATE
$done = date('Y/m/d');
$sql = 'UPDATE todolist SET done = :done WHERE id = :id';
$stmt = $pdo -> prepare($sql);
$stmt->bindParam(':done', $done, PDO::PARAM_STR);
$stmt->bindValue(':id', 6, PDO::PARAM_INT);
$stmt->execute();

// DELETE
$subject = '項目1%';
$sql = 'DELETE FROM todolist WHERE subject LIKE :delete_subject';
$stmt = $pdo -> prepare($sql);
$stmt -> bindParam(':delete_subject', $subject, PDO::PARAM_STR);
$stmt -> execute();

//全件検索一覧表格納
$rows = $pdo->query('SELECT * FROM todolist')->fetchAll(PDO::FETCH_ASSOC);

function hsc($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>DB接続サンプル4-レコード書き換え</title>
        <style type="text/css">
            table, td, th {
                border: solid black 1px;
            }
            table {
                width: 70%;
            }
        </style>
    </head>
    <body>
        <table>
<?php foreach ($rows as $row): ?>
            <tr>
  <?php foreach ($row as $column): ?>
                <td><?=hsc($column)?></td>
  <?php endforeach; ?>
            </tr>
<?php endforeach; ?>
        </table>
    </body>
</html>
