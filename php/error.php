<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset=utf-8" />
<title>エラー画面</title>
<link href="../css/stylesheet.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
$err = $_GET["err"];
if ($err == "none") {
	$msg = "ユーザーが存在しません";
} else if ($err == "unmached") {
	$msg = "パスワードが間違っています";
}
echo $msg;
?>
	<hr>
	<a href="login.php">ログイン画面に戻る</a>
</body>
</html>
