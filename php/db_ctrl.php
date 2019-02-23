<?php
//各ページからのDBテーブル操作に共通して通るコントローラー

$actions = ['regist', 'update', 'delete', 'cancel'];
foreach ($actions as $action) {
	if (isset($_POST[$action])) break;
}

echo "処理：".$action."<hr>";

if ($action === "regist") {
	// 新規項目名,担当者,期限,(完了は'未'→null,項目IDは自動採番)をINSERT
	$item_name = $_POST['item_name'];
	$user_name = $_POST['user_name'];
	$date = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
echo "項目名：".$item_name."<br>";
echo "担当者：".$user_name."<br>";
echo "期限：".$date."<br>";

} else if ($action === "update") {
	$item_id = $_POST[('item_id')];
	$item_name = $_POST['item_name'];
	$user_name = $_POST['user_name'];
	$date = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
	$finished = isset($_POST['finished_chk'])? "finished" : "unfinished";
echo "項目ID：".$item_id."<br>";
echo "項目名：".$item_name."<br>";
echo "担当者：".$user_name."<br>";
echo "期限：".$date."<br>";
echo "完了チェック：".$finished."<br>";

} else if ($action === "delete") {
	$item_id = $_POST[('item_id')];
echo "項目ID：".$item_id."<br>";

} else if ($action === "cancel") {
	// キャンセル処理(DBを更新せず全件検索し直し一覧画面に戻る)
	header('location: list.php', true, 301);
	exit;
}

?>
