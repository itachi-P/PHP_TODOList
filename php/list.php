<?php
//(廃止)GETもPOSTもセキュリティ上大差ないのでSESSIONに変更(更にはできればSSLを使うべき)
//$userID = $_GET['userID'];

session_start();

//自分自身にリダイレクトし、押されたボタンによってform actionの中身を動的に変えて遷移先を変更
//初期値(最初の1回は自分自身のページにリダイレクト)
if (!isset($_SESSION['url'])) {
	$_SESSION['url'] = "list.php";
	echo $_SESSION['url'];
} else {
	//以下で押されたボタンに合わせて遷移先を切り替える(最初の画面表示時は処理されない)
	//一応以下のやり方で画面遷移は切り分けられるものの、ホントにこんな冗長な書き方しか無いのか？
	echo $_SESSION['url'];

	//検索条件を元に検索をかけた結果画面に遷移
	if (isset($_POST['search'])) {
		$_SESSION['url'] = "search_result.php";
	} else if (isset($_POST['finish'])) {
		//（仮）
		//完了ボタンが押されたら「完了」欄を「未」から現在日付に書き換え「未完了」ボタンにラベルを変える
		//※「未完了」ボタンを押した時の処理はまた別に記述
		echo "<b>".$_GET['finish']."</b>";
	} else if(isset($_POST['update'])) {
		$_SESSION['url'] = "update.php";
	} else if (isset($_POST['delete'])) {
		$_SESSION['url'] = "delete.php";
	}
}

?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset=utf-8" />
<title>TODO一覧</title>
<link href="../css/list.css" rel="stylesheet" type="text/css">
</head>
<body>
	<h2>作業一覧</h2>
	<h4>ようこそ<?php echo $_SESSION['userID'] ?>さん</h4>
<form action="<?php echo $_SESSION['url'] ?>" method="POST">
	<div class="middle-wrapper">
		<div class="middle-left">
			<!-- input type="submit" をaタグに変更 -->
			<a class="btn-l" href="regist.php">作業登録</a>
		</div>
		<div class="middle-right">
			<p>検索キーワード</p>
			<input class="tbox" type="text" name="search_keyword">
			<!-- 後にinput type="submit"をtype="button"に変更しJavaScriptを組み込む -->
			<input name="search" class="btn" type="submit" value="検索">
		</div>
	</div>

	<div class="list-wrapper">
		<div class="list-header">
			<p>項目名</p>
			<p>担当者</p>
			<p>期限</p>
			<p>完了</p>
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
</form>

</body>
</html>