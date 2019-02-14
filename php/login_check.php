<?php

$userID = $_POST['userID'];
$pass = $_POST['password'];

// （仮）
// 下記は後にDB実装し、MySQLのテーブルに登録のあるユーザーかどうかでログイン成否を分ける
$regist_users = array("staff0" => "pass0", "staff7" => "pass7");
//ユーザー名は存在したかのフラグ
$usrExist = false;

foreach ($regist_users as $regID => $regPass) {
	if ($userID == $regID) {
		if ($pass == $regPass) {
			// ログイン成功
			$url = "list.php?userID=".$userID;
			//セッション開始
			session_start();
			//このページを介さずにlogin.phpで直接セッション開始→一覧画面へ遷移、に修正予定
			$_SESSION['userID'] = $userID;
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
//一瞬で自動遷移なのでユーザーが実際にこの画面を見ることは無いが、このページ自体が要らんワンクッションかな?
header("location: ".$url, true, 301);
exit;
?>
