<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset=utf-8" />
<title>WebApp開発実習-ログイン</title>
<link href="./css/login-form.css" rel="stylesheet" type="text/css"-->
</head>
<body>
	<p>2019/01/31～</p>
	<ol style="list-style-type: cjk-ideographic">
		<li class="next-plan">ユーザー登録作業(後で実装予定)</li>
		まずは最もシンプルな機能・画面で完成させた後、DB連動実装前に追加予定
		<li>ユーザー認証(最初はチェックを緩く)</li>
		最初はバリデーション(またはサニタイズ)のチェックを緩めに、まずは全体をシンプルに→雛形完成後に細部の作り込み
		<li>入力値チェック→問題があればエラー画面表示</li>
		エラー画面は全エラー共通画面、表示メッセージと戻り先ページのみ動的に変える方向でシンプルに作る
		<li>TODOリスト一覧表示画面に遷移</li>
		簡単なチェックのクリア後に最低限の入力データを渡し"list.php"に遷移
	</ol>
	<hr>
	<h2>ログイン画面</h2>
	<!-- もはや<table>タグ(<font>や<br>連打なども)の使用自体が「悪」らしいので以後使用禁止-->
	<div class="login-form">
		<form name="Login" method="post" action="login-check.php">
			<p class="login-title">ログイン</p>
			<hr>
			<div class="inputs">
				<div class="userID">
					ユーザーID
					<input type="text" name="userID" value="">
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

<?php

?>

</body>
</html>
