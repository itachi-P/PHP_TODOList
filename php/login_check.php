<?php

$userID = $_POST['userID'];
$pass = $_POST['password'];
echo "userID=".$userID."<br>";
echo "password=".$pass."<br>";

// （仮）
// 下記は後にDB実装し、MySQLのテーブルに登録のあるユーザーかどうかでログイン成否が分かれる
$regist_users = array("user01" => "pass01", "user02" => "pass02");

foreach ($regist_users as $regID => $regPass) {
	echo $regID."<br>";
	echo $regPass."<br>";
	if ($userID == $regID) {
		if ($pass == $regPass) {
			//echo "OK!";
			//$url = "list.php?userID=".$userID."&password=".$pass;
			$url = "list.php?userID=".$userID;
			break;
		} else {
			//echo "パスワードが間違っています";
			$url = "error.php?err=unmached";
			break;
		}
	} else {
		//echo 'ユーザーが存在しません';
		$url = "error.php?err=none";
		break;
	}
}
header("location: ".$url);

?>
