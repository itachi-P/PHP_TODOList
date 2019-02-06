<?php

$subject = $_GET['subject'];
$staff = $_GET['staff'];
$date = $_GET['year'].$_GET['month'].$_GET['day'];
$process = $_GET['regist'];

echo "項目名：".$subject."<br>";
echo "担当者：".$staff."<br>";
echo "期限：".$date."<br>";
echo "処理：".$process."<hr>";

if ($process == "登録") {
	echo "登録処理(MySQLに新規項目を担当者・期限と紐づけしINSERT)";
} else if ($process == "キャンセル") {
	echo "キャンセル処理(DBを更新せずに全件検索し直し一覧画面に戻る)";
}


?>