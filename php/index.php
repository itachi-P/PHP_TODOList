<?php
$head_title = "Webアプリ開発実習(PHP)";
$css_file = "defaultCSS.css";
require_once("head_template.php");
?>

<body style="background-image: url(../images/cafeArt-PiggyBank.jpg); background-size: cover;">
	<h1>Web開発実習PHPホーム</h1>
	<h4>サンプルWebアプリケーション仕様</h4>
	<hr>
	<h3>実装予定機能リスト（随時追記）</h3>
		<ul style="color: #9c7;">
			<li>ログイン機能</li>
				<ul style="list-style-type: square;">
					<li style="opacity: 0.7">ユーザー登録(Ver.2実装予定)</li>
					<li style="opacity: 0.7">ユーザー削除(Ver.2実装予定)</li>
				</ul>
			<li>作業管理機能</li>
			<ul>
				<li style="text-decoration: line-through">作業一覧の表示・検索</li>
				<li>作業の追加</li>
				<li style="text-decoration: line-through">作業の完了・未完了の更新</li>
				<li>作業の情報（項目名・担当者など）の更新</li>
				<li>作業の削除</li>
				<li>全てのエラー共通画面</li>
			</ul>
			<li style="text-decoration: line-through">
				DB非連動で上記実装の後にデータ取得法をDBに移行</li>
			<ol>
				<li style="text-decoration: line-through;">MySQL環境構築</li>
				<li style="text-decoration: line-through;">DB設計</li>
				<li style="text-decoration: line-through;">DB連携(PDO)実装</li>
				<li style="opacity: 0.7">トランザクション処理(Ver.2実装予定)</li>
			</ol>
		</ul>
	</div>
	<hr>
	<a href="./login.php">ログイン画面へ</a>
</body>
</html>