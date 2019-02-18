<?php
require_once("make_buttons.php");

/* 20190218N超改変 HTML画面構成→<table>、画面遷移方法→ボタン1個毎に<form>、CSS→シンプル化 */
session_start();
// ログイン状態になければログイン画面に戻す empty()は!isset()と違い"", 0, '0', 空の配列も弾く
if (empty($_SESSION['customer'])) {
	header("location: login.php", true, 301);
	exit;
}
// リスト表示画面右上に表示するログインユーザーの名前
$guestname = $_SESSION['customer']['name'];

/* 以下でDBにアクセスしTODOリスト全件を表示 
	※hostはWindows環境の場合'localhost'よりIPアドレス指定の方が処理が速い？ */
$dsn = 'mysql: host=127.0.0.1; dbname=shino; charset=utf8mb4';
$driver_options = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_EMULATE_PREPARES => false,
	];

try {
	// DBH:データベースハンドラ ($pdoと書かれることが多い)
    $dbh = new PDO($dsn,'user1','pass1', $driver_options);

	//「完了」「未完了」ボタン押下時の処理分け
	if (isset($_POST['action']) && isset($_POST['item_id'])) {
		if ($_POST['action'] === 'finished') {
			// 完了ボタンが押されたら「完了」欄を「未」から現在日付に書き換え、かつ「未完了」ボタンに変える
			$sql = "UPDATE TODO_ITEM SET FINISHED_DATE = DATE_FORMAT(now(), '%Y/%m/%d')
					WHERE ID = ".$_POST['item_id'];
			$dbh->exec($sql);

		} else if ($_POST['action'] === 'unfinished') {
			// 該当するレコードのitem_idをキーに「完了」カラムの日付データ削除（nullに上書き→'未'）
			$sql = "UPDATE TODO_ITEM SET FINISHED_DATE = null
					WHERE ID = ".$_POST['item_id'];
			$dbh->exec($sql);
		}
	}

	// 全件検索
	$sql = "SELECT todo_item.id AS item_id,
					todo_item.name AS item_name,
					todo_user.name AS user_name,
					todo_item.expire_date AS term,
					todo_item.finished_date AS done
			 FROM todo_user JOIN todo_item
			 ON todo_user.id = todo_item.user
			 ORDER BY expire_date ASC";

	/* (Ver.2改修予定)モードをFETCH_CLASSに変更し、DBレコード&「操作」ボタン群をオブジェクト化 */
	// ★FETCH_ASSOCとFETCH_UNIQUEを組み合わせることで、連想配列の添字に整数連番でなくidが使える
    $rows = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_UNIQUE);

} catch (PDOException $e) {
	// エラー発生時に壊れたHTML画面ではなくプレーンテキストでエラーメッセージのみ表示
    header('Content-Type: text/plain; charset=UTF-8mb4', true, 500);
    exit($e->getMessage());
}

function hsc($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); //※mb4指定はエラー
}

$head_title = "TODO一覧";
$css_file = "list.css";
require_once("head_template.php");
?>

<body>
	<h1>作業一覧</h1>
	<div class="guestname">ようこそ <?= $guestname ?> さん</div>
	<div class="middle-left">
		<form action="regist.php" method="POST">
			<input type="hidden" name="action" value="regist">
			<input class="btn" type="submit" value="作業登録">
		</form>
	</div>
	<div class="middle-right">
		<form action="search.php" method="POST">
			<p>検索キーワード</p>
			<input type="hidden" name="action" value="search">			
			<!-- (Ver.2改修予定) 後にtype="submit"を"button"に変更しJavaScriptを組み込む -->
			<input class="tbox" type="text" name="search_keyword">
			<input class="btn" type="submit" value="検索">
		</form>
	</div>
	<table class="list-wrapper">
	<thead>
		<tr>
			<td>項目名</td><td>担当者</td><td>期限</td><td>完了</td><td colspan="3">操作</td>
		</tr>
	</thead>
	<tbody>

<?php foreach($rows as $row):
	// 対象行の担当者がログインユーザーの場合、背景をピンクに(下の完了済み→グレーが優先)※要確認
	$bgc = ($row['user_name'] === $guestname)? "pink" : "#fff";
		// 「完了」がnullの場合'未'と表示、日付データがあれば背景をグレーに
	($row['done'] === null)? $row['done'] = '未' : $bgc = "gray"; ?>
		<tr style="background-color: <?=$bgc?>">
	<?php foreach ($row as $column): ?>
    		<td><?= hsc($column) ?></td>
	<?php endforeach ?>
	<!-- ここで「操作」欄のボタン群を形成 -->
			<?php hsc(makeBtns($rows)); ?>
		
	</tr>
<?php
	// 現在行のID取得用関数key($rows)がフェッチに合わせて自動で進まないので手動で進める
	next($rows);
	endforeach ?>

	</tbody>
	</table>
</body>
</html>
