<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset=utf-8" />
<title>TODO一覧</title>
<link href="../css/list.css" rel="stylesheet" type="text/css">
</head>
<body>
	<h2>作業一覧</h2>
<?php

//(仮) GETもPOSTもセキュリティ上大差ないので後にSESSIONに変更予定(更にはできればSSTを使うべき)
$userID = $_GET['userID'];

echo "<h4>ようこそ　".$userID."　さん</h4>";

//押されたボタンによってform actionの中身を変える
//最初の画面表示および1回目の画面遷移時は自分自身にリダイレクト
$url = "list.php";
//以下で押されたボタンに合わせて遷移先を切り替える(最初は処理を飛ばす)
if($_GET['id'] != "") {
	echo "<b>".$_GET['id']."</b>";
	echo "<b>".$_GET['name']."</b>";
}

?>
<form action="<?php echo $url ?>">
	<div class="middle-wrapper">
		<div class="middle-left">
			<!-- input type="submit" をaタグに変更 -->
			<a class="btn-l" href="regist.php">作業登録</a>
		</div>
		<div class="middle-right">
			<p>検索キーワード</p>
			<input class="tbox" type="text" name="search_keyword">
			<!-- 後にinput type="submit"をtype="button"に変更しJavaScriptを組み込む -->
			<input id="search" class="btn" type="submit" value="検索">
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
    if ($staff == $userID) {
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