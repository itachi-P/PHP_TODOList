<?php
//各ページからのDBテーブル操作に共通して通るコントローラー

$item_name = $_GET['item_name'];
$user_name = $_GET['user_name'];
$date = $_GET['year']."-".$_GET['month']."-".$_GET['day'];

$actions = ['regist', 'search', 'update', 'delete', 'cancel'];
foreach ($actions as $action) {
	if (isset($_GET[$action])) break;
}

echo "action:".$_GET['action']."###<br>";

echo "項目名：".$item_name."<br>";
echo "担当者：".$user_name."<br>";
echo "期限：".$date."<br>";
echo "処理：".$action."<hr>";

if ($action === "regist") {
	// 新規項目,担当者,期限,(完了はnull)をINSERT

} else if ($action === "search") {

} else if ($action === "update") {

} else if ($action === "delete") {

} else if ($action === "cancel") {
	// キャンセル処理(DBを更新せず全件検索し直し一覧画面に戻る)
//	header('location: list.php', true, 301);
//	exit;
}


//header("location: list.php", true, 301);
//exit;
?>
