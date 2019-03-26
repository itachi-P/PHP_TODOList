<?php
session_start();
// セッションを全て破棄
$_SESSION = array();
if  (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
// 最終的にセッションを破壊する
session_destroy();

$head_title = "ログイン画面";
$css_file = "login-form.css";
require_once("header.tmp.php");
?>

<body>
<!--
	<span style="color:#77a; font-size: 18px">Ver.2 改修予定</span>
	<ol style="list-style-type: cjk-ideographic">
		<li>ユーザー登録・削除機能</li>
			登録済み固定ユーザーに加え、新規ユーザー登録を受付
		<li>ユーザー認証</li>
			パスワードのハッシュ化、バリデーション(orサニタイズ)チェック強化
	</ol>
	<hr>
-->
	<h1 id="title">ToDoリスト_ログイン</h1>
	<div class="login-form">
		<form method="post" action="./login_check.php">
			<h2>ログイン</h2>
			<hr>
			<div class="inputs">
				<p>
					ユーザーID
					<input type="text" name="userID" class="textbox" size="15" maxlength="15" required value="user01">
				</p>
				<p>
					パスワード
					<input type="password" name="password" class="textbox" size="15" maxlength="15" required value="pass01">
				</p>
				<span>
				※（初期入力）テスト用ユーザー※</br>
				ユーザーID: user01 パスワード: pass01
				</span>
			</div>
			<p class="btn-wrapper">
				<input class="btn" type="submit" value="ログイン">
			</p>
		</form>
	</div>
<?php require_once("footer.tmp.php"); ?>
</body>
</html>
