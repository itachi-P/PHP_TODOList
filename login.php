<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset=utf-8 " />
<title>WebApp開発実習-ログイン</title>
<!--link href="./css/stylesheet.css"rel="stylesheet" type="text/css"-->
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

	<div class="login">
	<h2>ログイン画面</h2>
	<table width="50%" rules="all" align="center">
	<form name="Login" method="post" action="login-check.php">
		<tr>
			<caption>
				<B>ログイン</B>
				<hr>
			<details>
				<summary>このテーブルの説明</summary>
					<p>説明不要ながらdetails, summaryタグを使ってみた</p>
			</details>
			</caption>
			<td>ユーザーID</td>
			<td><input type="text" name="userID" value=""></td>
		</tr>
		<tr>
			<td>パスワード</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr align="center">
			<td>
				<input type="submit" value="ログイン">
			</td>
		</tr>
	</form>
	</table>

<?php

?>

</body>
</html>