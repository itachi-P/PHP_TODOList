<?php
$head_title = "ログイン画面";
$css_file = "login-form.css";
require_once("head_template.php");
?>

<body>
	<ol style="list-style-type: cjk-ideographic">
		<li><span>ユーザー登録・削除作業</span></li>
		最初のバージョンではDB登録済み固定ユーザー認証のみで全体の機能・画面完成を優先
		<li style="text-decoration: line-through">ユーザー認証</li>
			最初はバリデーション(orサニタイズ)のチェック緩めに
			<span>(Ver.2de改修予定) パスワードをハッシュ化して保持→DBもvarchar(100)に拡張</span>
		<li style="text-decoration: line-through">入力値チェック→問題があればエラー画面表示(全エラー共通画面)</li>
			エラー画面は全エラー共通画面で表示メッセージのみ動的に変更→ログイン画面に戻る
		<li style="text-decoration: line-through">TODOリスト一覧表示画面に遷移</li>
			入力値チェッククリア後画面遷移
			<span>→簡易な雛形完成後にVer.2として細部の作り込み</span>
		<li><span>(Ver.2改修予定) トランザクション処理</span></li>
	</ol>
	<hr>
	<h1 id="title">ログイン画面</h1>
	<div class="login-form">
		<form method="post" action="./login_check.php">
			<h2>ログイン</h2>
			<hr>
			<div class="inputs">
				<p>
					ユーザーID
					<input type="text" name="userID" size="15" maxlength="15">
				</p>
				<p>
					パスワード
					<input type="password" name="password" size="15" maxlength="15">
				</p>
				<p>※テスト用ユーザー※</p>
				<p>ユーザーID:user01</p>
				<p>パスワード:pass01
				</p>
			</div>
			<p class="btn-wrapper">
				<input class="btn" type="submit" value="ログイン">
			</p>
		</form>
	</div>
</body>
</html>
