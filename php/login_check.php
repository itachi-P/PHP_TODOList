<?php

$userID = $_POST['userID'];
$pass = $_POST['password'];
echo "userID=".$userID."<br>";
echo "password=".$pass."<br>";

// （仮）
// 下記は後にDB実装し、MySQLのテーブルに登録のあるユーザーかどうかでログイン成否が分かれる
$regist_users = array("staff0" => "pass0", "staff7" => "pass7");
//DBにユーザー名は存在したかのフラグ
$usrExist = false;

foreach ($regist_users as $regID => $regPass) {
	echo $regID."<br>";
	echo $regPass."<br>";
	if ($userID == $regID) {
		if ($pass == $regPass) {
			//echo "OK!";
			$url = "list.php?userID=".$userID;
			break;
		} else {
			// ユーザー名は存在するがパスワードが間違っている場合";
			$url = "error.php?err=unmached";
			$usrExist = true;
		}
	} else {
		if ($usrExist == false) {
			//ユーザー名自体がDBに存在しない場合';
			$url = "error.php?err=none";
		}
	}
}
header("location: ".$url);

?>
