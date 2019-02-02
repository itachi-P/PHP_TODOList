<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset=utf-8" />
<title>TODO一覧</title>
<link href="../css/list.css" rel="stylesheet" type="text/css">
</head>
<body>
	<!-- h1 id="title">TODO管理<br>一覧画面</h1 -->
	<h3>作業一覧</h3>
	<hr>

<?php

//(仮)
$userID = $_GET['userID'];
//$pass = $_GET['password'];

echo "<h4>ようこそ　".$userID."　さん</h4>";
?>
	<div class="middle-wrapper">
		<div class="middle-left">
			<input class="btn-l" type="submit" value="作業登録">
		</div>
		<div class="middle-right">
			<p>検索キーワード</p>
			<input class="tbox" type="text" name="search">
			<input class="btn" type="submit" value="検索">
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
    echo "<p>".$data->getSubject()."</p>";
    echo "<p>".$data->getStaff()."</p>";
    echo "<p>".$data->getTerm()."</p>";
    echo "<p>".$data->getCompletion()."</p>";
    echo "<p>".$data->getControls()."</p>";
}


?>
		</div> <!-- list-main-->

	</div>	<!-- list-wrapper -->


</body>
</html>