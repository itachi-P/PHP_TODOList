<?php
//前のページindex.phpで開始した訪問カウンター用のセッションの明示的な終了
$_SESSION = array();	//セッション変数の全破棄(セッション自体の終了ではない)

//(要調査)
//session_destroy();
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset=utf-8" />
<title>WebApp開発実習-ログイン</title>
<link href="../css/login-form.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="../images/fuca_tehepero_icon_32x32.ico">
</head>
<body>
	<p>2019/01/31～</p>
	<ol style="list-style-type: cjk-ideographic">
		<li class="next-plan">ユーザー登録作業</li>
		DB非連動固定ユーザーで全体の機能・画面完成を優先→DB連動に移行
		<li class="implemented">ユーザー認証</li>
		最初はバリデーション(またはサニタイズ)のチェック緩めに
		<li class="next-plan">入力値チェック→問題があればエラー画面表示</li>
		エラー画面は全エラー共通画面、表示メッセージと戻り先ページのみ動的に変える
		<li class="implemented">TODOリスト一覧表示画面に遷移</li>
		入力値チェッククリア後画面遷移→簡易な雛形完成後に細部の作り込み
	</ol>
	<hr>
	<h1 id="title">ログイン画面</h1>
	<!-- もはや<table>タグ(<font>や<br>連打なども)の使用自体が「悪」らしいので以後使用禁止-->
	<div class="login-form">
		<!-- とりあえず仮にワンクッション挟んで実際にはユーザーに見えない画面でログインチェックの仕様 -->
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
