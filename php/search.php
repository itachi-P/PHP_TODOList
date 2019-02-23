<?php
//一覧画面と同じ構成で検索結果一覧と、「戻る」ボタンをリスト左側上端と下端に配置する
require_once("make_buttons.php");

session_start();
// ログインユーザーの名前
$guestname = $_SESSION['customer']['name'];

// この画面が直接表示された場合エラー画面に飛ばす
if (empty($_POST['action'])) {
	$url = "error.php?err=unauthorized_access";
	header("location: ".$url, true, 301);
	exit;
}
// (要仕様確認)検索キーワードに何も入力されない場合そのまま再度全件検索ではなくエラー扱いにするか？
// if (empty($_POST['search_keyword']) {}

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

	// (予定）ユーザー入力に基づき検索 ※ユーザー入力値なので必ずプリペアドステートメント→バインドすること
	$search_keyword = $_POST['search_keyword'];
echo "検索キーワード：".$_POST['search_keyword'];

	$sql = "SELECT todo_item.id AS item_id,
					todo_item.name AS item_name,
					todo_user.name AS user_name,
					todo_item.expire_date AS term,
					todo_item.finished_date AS done
			 FROM todo_user JOIN todo_item
			 ON todo_user.id = todo_item.user
			 ORDER BY expire_date ASC";

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

$head_title = "検索結果画面";
$css_file ="list.css";
require_once("head_template.php");
?>

<body>
<h1>検索結果</h1>
	<div class="middle-wrapper">
		<form action="list.php" method="POST">
			<input class="btn" type="submit" value="戻る">
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
	<form action="list.php" method="POST">
		<input class="btn" type="submit" value="戻る">
	</form>
</body>
</html>