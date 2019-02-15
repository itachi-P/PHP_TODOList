<?php
//一覧画面と同じ構成で検索結果一覧と、「戻る」ボタンをリスト左側上端と下端に配置する

session_start();



/* if (!isset($_SESSION['url'])) {
	//この条件分岐は不要で else以下の処理だけでいいのでは？
	$_SESSION['url'] = "list.php";
} else { */
	//以下で押されたボタンに合わせて遷移先を切り替える(最初の画面表示時は処理されない)
	//一応以下のやり方で画面遷移は切り分けられるものの、ホントにこんな冗長な書き方しか無いのか？

	if (isset($_POST['finish'])) {
		//（仮）
		//完了ボタンが押されたら「完了」欄を「未」から現在日付に書き換え「未完了」ボタンにラベルを変える
		//※「未完了」ボタンを押した時の処理はまた別に記述
echo "<b>".$_POST['finish']."</b>";
	} else if(isset($_POST['update'])) {
		$_SESSION['url'] = "update.php";
	} else if (isset($_POST['delete'])) {
		$_SESSION['url'] = "delete.php";
	}

	if (isset($_SESSION['url'])) {
		header("location: ".$_SESSION['url']);
		unset($_SESSION['url']);
	}
//}

?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset=utf-8" />
<title>検索結果画面</title>
<link href="../css/list.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2>検索結果</h2>
<form action="list.php" method="POST">
	<div class="middle-wrapper">
		<input name="back" class="btn" type="submit" value="戻る">
	</div>

	<div class="list-wrapper">
		<div class="list-header">
			<p>項目名</p>
			<p>担当者</p>
			<p>期限</p>
			<p>完了状態</p>
			<p>操作</p>
		</div>

		<div class="list-main">
<?php

//リスト全データの読み込み
require_once("list_data.php");

foreach ($datas as $data) {
   $staff = $data->getStaff();
    if ($staff == $_SESSION['userID']) {
    	echo "<div class=\"my-task\">";
    } else {
    	echo "<div class=\"others-task\">";
    }
 	echo "<p>".$data->getSubject()."</p>";    		
    echo "<p>".$staff."</p>";
    echo "<p>".$data->getTerm()."</p>";
    echo "<p>".$data->getCompletion()."</p>";
    echo "<p>".$data->getControls()."</p>";
    echo "</div>";
}

?>
		</div> <!-- list-main-->
	</div>	<!-- list-wrapper -->

	<div class="bottom-wrapper">
		<input name="back" class="btn" type="submit" value="戻る">
	</div>
</form>

</body>
</html>