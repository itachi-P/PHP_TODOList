<?php
//echo phpinfo();
//DB接続サンプル2 - 手続き型接続
//mysql関数はPHP5.5以降は非推奨となり、将来的には削除される予定なのでサンプル1のようにPDOの使用を推奨
$todolists = array();
$order = 'ASC';
if (isset($_GET['order']) === TRUE) { $order = $_GET['order']; }
$host = 'localhost'; // データベースのホスト名又はIPアドレス
$username = 'user1'; // MySQLのユーザ名
$passwd = 'pass1'; // MySQLのパスワード
$dbname = 'shino'; // データベース名
$link = mysqli_connect($host, $username, $passwd, $dbname);
// 接続成功した場合
if ($link) {
	// 文字化け防止
	mysqli_set_charset($link, 'utf8');
	$query = 'SELECT id, subject, staff, term, done FROM todolist ORDER BY term ' . $order;
	// クエリを実行します
	$result = mysqli_query($link, $query);
	// 1行ずつ結果を配列で取得します
	while ($row = mysqli_fetch_array($result)) { $todolists[] = $row; }
	// 結果セットを開放します
	mysqli_free_result($result);
	// 接続を閉じます
	mysqli_close($link);
	// 接続失敗した場合
} else { print 'DB接続失敗'; }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>MySQL接続サンプル2(mysqli)</title>
		<style type="text/css">
        table, td, th {
            border: solid black 1px;
        }
        table {
            width: 60%;
        }
    </style>
</head>
<body>
	<h1>TODOリスト(期限日付順)</h1>
	<a style="display:block;float:left;margin-right:20px;" href="index.php">戻る</a>
	<form>
        <input type="radio" name="order" value="ASC" <?php if ($order === 'ASC') {print 'checked';} ?>>昇順
        <input type="radio" name="order" value="DESC" <?php if ($order === 'DESC') {print 'checked';} ?>>降順
        <input type="submit" value="表示">
    </form>

	<table style="border: solid 1px #777;">
		<tr width>
			<th>ID</th>
			<th>項目名</th>
			<th>担当者</th>
			<th>期限</th>
			<th>完了</th>
    </tr>
<?php foreach ($todolists as $value) { ?>
		<tr>
			<td><?php print htmlspecialchars($value['id'], ENT_QUOTES, 'UTF-8'); ?></td>
			<td><?php print htmlspecialchars($value['subject'], ENT_QUOTES, 'UTF-8'); ?></td>
			<td><?php print htmlspecialchars($value['staff'], ENT_QUOTES, 'UTF-8'); ?></td>
			<td><?php print htmlspecialchars($value['term'], ENT_QUOTES, 'UTF-8'); ?></td>
			<td><?php print htmlspecialchars($value['done'], ENT_QUOTES, 'UTF-8'); ?></td>
    </tr>
<?php } ?>
    </table>
</body>
</html>
