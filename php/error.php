<?php
$head_title = "エラー処理共通画面";
$css_file = "regist.css";
require_once("header.tmp.php");

$err = $_GET["err"];
if ($err === "login_failed") {
	$msg = "ユーザーID、パスワードが間違っています";
} else if ($err === "unmached") { // 現状ここに入ることはない
	$msg = "パスワードが間違っています";
} else if ($err === "unauthorized_access") {
	$msg = "不正なアクセスです";
}
?>

<body>
	<h1>エラー</h1>
	<div class="container">
		<form action="login.php">
			<div style="width: 100%">
				<h2>エラーが発生しました。</h2>
				<hr>
				<h2>内容：<?= $msg ?></h2>
			</div>
			<div style="text-align: center">
			<input class="btn" type="submit" value="戻る">
			</div>
		</form>
	</div> <!-- container -->
</body>
</html>