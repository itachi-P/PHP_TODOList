<?php 
/* セッションを利用して訪問回数を保持してみる */
//セッションの開始 (有効期限のデフォルトは'0'でブラウザを閉じるまで保持される)
session_start();

// セッションにキー'count'の登録が無ければ登録と同時に初期値として1を設定
// issetでキーの存在確認、unsetで登録キーの削除(セッションを終える際には明示的全削除処理が望ましい)
if (!isset($_SESSION['count'])) {	//isset() 変数がセットされているかどうかを返す関数
	$_SESSION['count'] = 1;
} else {
	// キー'count'が既に登録されていれば、その値をインクリメント
	$_SESSION['count']++;
}
echo "<div style='color:#7b8; max-width:800px; border:1px solid #ccf;'>"
	.$_SESSION['count']."回目の訪問です</dir>";
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset=utf-8" />
<title>Webアプリ開発実習(PHP)</title>
<link href="../css/stylesheet.css" rel="stylesheet" type="text/css">
<meta name="keywords" content="Webアプリ開発練習">
<meta name="description" content="15年ぶりエンジニア復帰中年が一から学習し直し最初のWebアプリケーション(PHP)開発実習(2019/1/30開始)">
</head>

<body>
	<h1>Web開発実習PHPホーム</h1>
	<h2>サンプルWebアプリケーション仕様</h2>
	<hr>
	<div class="planList">
		<p>実装予定機能リスト（随時追記）</p>
		<ul class="plans">
			<li class="implemented">ログイン機能</li>
				<ul class="next-plan" style="list-style-type: square;">
					<li>ユーザー登録</li>
					<li>登録削除</li>
				</ul>
			<li>作業管理機能</li>
			<ul>
				<li>作業一覧の表示・検索</li>
				<li>作業の追加</li>
				<li>作業の完了・未完了の更新</li>
				<li>作業の情報（項目名・担当者など）の更新</li>
				<li>作業の削除</li>
				<li>全てのエラー共通画面</li>
			</ul>
			<li class="plan2">PHPのみで上記実装の後にデータ取得をDBに移行</li>
			<ol class="plan2">
				<li>SQLの復習から開始</li>
				<li>MySQL利用（予定）・環境構築</li>
				<li>DB設計</li>
				<li>DB実装</li>
				<li>テスト</li>
			</ol>
		</ul>
	</div>
	<hr>
	<a style="display:block;margin-bottom:20px" href="login.php">ログイン画面へ</a>
	<h4 style="background-color:#f99;padding:20px;border:3px dashed #777">御神籤</h4>
<?php

$fortune = rand(1,7);
if ($fortune == 7) {
	$result = "<font color=\"magenta\">大吉♡</font>";
} else if ($fortune % 3 == 0) {
	$result = "中吉どす！";
} else if ($fortune == 1) {
	$result = "<font color=\"red\">凶</font>と出ました oh…";
} else {
	$result = "小吉ですね";
}
echo "今日の運勢は${result}";

?>

</body>
</html>