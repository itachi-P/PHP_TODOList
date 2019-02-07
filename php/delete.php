<?php
session_start();


?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset=utf-8" />
<title>削除確認画面</title>
<link href="../css/stylesheet.css" rel="stylesheet" type="text/css">
<link href="../css/regist.css" rel="stylesheet" type="text/css">
</head>
<body>
	<h2>削除確認</h2>
	<div class="container">
		<form action="db_ctrl.php" method="get">
			<h1>項目　<?php $_SESSION['subject'] ?>　を削除します。
				よろしいですか？
			</h1>

			<div class="buttons-wrapper">		
				<input class="btn" type="submit" value="削除" name="delete">
				<input class="btn" type="submit" value="キャンセル" name="cancel">
			</div> <!-- buttons-wrapper -->
		</form>
	</div> <!-- container -->
</body>
</html>