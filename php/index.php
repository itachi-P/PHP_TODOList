<?php
$head_title = "Webアプリ開発実習(PHP)";
$css_file = "defaultCSS.css";
require_once("header.tmp.php");
?>

<body style="background-image: url(../images/cafeArt-PiggyBank.jpg); background-size: cover;">
	<h1>Web開発実習PHPホーム</h1>
	<h4>サンプルWebアプリケーション仕様</h4>
	<hr>
	<h3>実装予定機能リスト</h3>
	<ul style="color: #ffc;">
		<li>ログイン機能</li>
			<ul style="list-style-type: square;">
				<li class="unimplemented" style="opacity: 0.8">ユーザー登録</li>
				<li class="unimplemented" style="opacity: 0.8">ユーザー削除</li>
			</ul>
		<li>作業管理機能</li>
		<ul>
			<li style="text-decoration: line-through">作業一覧の表示・検索</li>
			<li style="text-decoration: line-through">作業の追加/li>
			<li style="text-decoration: line-through">作業の完了・未完了の更新</li>
			<li style="text-decoration: line-through">作業情報（項目名・担当者など）の更新</li>
			<li style="text-decoration: line-through">作業の削除</li>
			<li style="text-decoration: line-through">全てのエラー共通画面</li>
		</ul>
		<li>データベース連動</li>
		<ol>
			<li style="text-decoration: line-through;">環境構築</li>
			<li style="text-decoration: line-through;">テーブル設計</li>
			<li style="text-decoration: line-through;">DB連携(PDO)実装</li>
			<li class="unimplemented" style="opacity: 0.8">トランザクション処理</li>
		</ol>
		<li>その他</li>
		<ul>
			<li style="text-decoration: line-through">ヘッダー・フッターのテンプレートファイル化</li>
			<li style="text-decoration: line-through">全ページレスポンシブ対応</li>
		</ul>
	</ul>
	</div>
	<hr>
	<h4><a href="./login.php">ログイン画面へ</a></h4>
	<?php require_once("footer.tmp.php"); ?>
</body>
</html>