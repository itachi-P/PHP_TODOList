<?php
//各ページからのDBテーブル操作に共通して通るコントローラー

$actions = ['regist', 'update', 'delete', 'cancel'];
foreach ($actions as $action) {
	if (isset($_POST[$action])) break;
}
//echo "処理：".$action."<hr>";

if ($action === "regist") {
	// 新規項目名,担当者,期限,(完了は'未'→null,項目IDは自動採番)をINSERT
	$item_name = $_POST['item_name'];
	$user_id = $_POST['user_id'];
	$month = $_POST['month'];
	$day = $_POST['day'];
	if (strlen($month) === 1) {
		$month = "0".$month;
	}
	if (strlen($day) === 1) {
		$day = "0".$day;
	}
	$term = $_POST['year']."-".$month."-".$day;
//echo "項目名：".$item_name."<br>";
//echo "担当者ID：".$user_id."<br>";
//echo "期限：".$term."<br>";

$sql = "INSERT INTO TODO_ITEM (NAME, USER, EXPIRE_DATE)
		VALUES (:item_name, :user_id, :term)";

} else if ($action === "update") {
	$item_id = $_POST[('item_id')];
	$item_name = $_POST['item_name'];
	$user_id = $_POST['user_id'];
	$month = $_POST['month'];
	$day = $_POST['day'];
	if (strlen($month) === 1) {
		$month = "0".$month;
	}
	if (strlen($day) === 1) {
		$day = "0".$day;
	}
	$term = $_POST['year']."-".$month."-".$day;
	$finished = isset($_POST['finished_chk'])? date('Y-m-d') : null;
/*echo "項目ID：".$item_id."<br>";
echo "項目名：".$item_name."<br>";
echo "担当者ID：".$user_id."<br>";
echo "期限：".$term."<br>";
echo "完了：".$finished."<br>";
*/
$sql = "UPDATE TODO_ITEM
		SET NAME = :item_name, USER = :user_id, EXPIRE_DATE = :term, FINISHED_DATE = :finished
		WHERE ID = :item_id";

} else if ($action === "delete") {
	$item_id = $_POST[('item_id')];
//echo "項目ID：".$item_id."<br>";

$sql = "DELETE FROM TODO_ITEM WHERE ID = :item_id";

} else if ($action === "cancel") {
	// キャンセル処理(DBを更新せず全件検索し直し一覧画面に戻る)
	header('location: list.php', true, 301);
	exit;
}

try {
	//For Heroku
    $url = parse_url(getenv('CLEARDB_DATABASE_URL'));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $pdo = new PDO(
      'mysql:host=' . $server . ';dbname=' . $db . ';charset=utf8mb4',
      $username,
      $password,
      [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
      ]
    );

	$stmt = $pdo -> prepare($sql);
	if ($action === "regist") {
		$stmt->bindValue(":item_name", $item_name, PDO::PARAM_STR);
		$stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
		$stmt->bindValue(":term", $term, PDO::PARAM_STR);
	} else if ($action === "update") {
		$stmt->bindValue(":item_id", $item_id, PDO::PARAM_INT);
		$stmt->bindValue(":item_name", $item_name, PDO::PARAM_STR);
		$stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
		$stmt->bindValue(":term", $term, PDO::PARAM_STR);
		$stmt->bindValue(":finished", $finished, PDO::PARAM_STR);
	} else if ($action === "delete") {
		$stmt->bindValue(":item_id", $item_id, PDO::PARAM_STR);
	}
	$result = $stmt->execute();
//echo $sql."<br>";
//echo "DB操作の結果は：".$result; 

} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}

// DB操作が全て終わったら自動的にTODO一覧画面に飛ばす
header("location: list.php", true, 301);
exit;

?>
