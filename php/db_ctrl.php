<?php
//各ページからのDBテーブル操作に共通して通るコントローラー

$item_name = $_GET['item_name'];
$user_name = $_GET['user_name'];
$date = $_GET['year'].$_GET['month'].$_GET['day'];

$process = "";
isset($_GET["update"]);
isset($_GET["delete"]);
isset($_GET["cancel"]);	

echo "項目名：".$item_name."<br>";
echo "担当者：".$user_name."<br>";
echo "期限：".$date."<br>";
echo "処理：".$process."<hr>";

if ($process == "登録") {
	echo "登録処理(MySQLに新規項目を担当者・期限と紐づけしINSERT)";
} else if ($process == "キャンセル") {
	echo "キャンセル処理(DBを更新せずに全件検索し直し一覧画面に戻る)";
}


//header("location: list.php", true, 301);
exit;
?>