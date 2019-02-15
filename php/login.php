<?php
$head_title = "ログイン画面";
$css_file = "login-form.css";
require_once("head_template.php");
?>

<body>
	<ol style="list-style-type: cjk-ideographic">
		<li>ユーザー登録作業</li>
		最初のバージョンでは登録済み固定ユーザー認証のみで全体の機能・画面完成を優先
		<li>ユーザー認証</li>
		最初はバリデーション(orサニタイズ)のチェック緩めに
			<span>(改修予定)Ver2 パスワードをハッシュ化して保持</span>
		<li>入力値チェック→問題があればエラー画面表示(全エラー共通画面)</li>
		エラー画面は全エラー共通画面、表示メッセージと戻り先ページのみ動的に変える
		<li>TODOリスト一覧表示画面に遷移</li>
		入力値チェッククリア後画面遷移
			<span>→簡易な雛形完成後に細部の作り込み</span>
	</ol>
	<hr>
	<h1 id="title">ログイン画面</h1>
	<div class="login-form">
		<form name="Login" method="post" action="login_check.php">
			<h2>ログイン</h2>
			<hr>
			<div class="inputs">
				<div class="userID">
					ユーザーID
					<input type="text" name="userID">
				</div>
				<div class="password">
					パスワード
					<input type="password" name="password">
				</div>
			</div>
			<p class="btn-wrapper">
				<input class="btn" type="submit" value="ログイン">
			</p>
		</form>
	</div>
</body>
</html>
