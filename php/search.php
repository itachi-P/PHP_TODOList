<?php
//一覧画面と同じ構成で検索結果一覧と、「戻る」ボタンをリスト左側上端と下端に配置する
session_start();

//完了ボタンが押されたら「完了」欄を「未」から現在日付に書き換え、かつ「未完了」ボタンに変える
//※「未完了」ボタンが押された時は上記の逆の操作を行う。
if (isset($_POST['finished'])) {
	$sql = "UPDATE TODO_ITEM SET FINISHED_DATE = DATE_FORMAT(now(), '%Y/%m/%d') WHERE ID = :id";

} else if (isset($_POST['unfinished'])) {
	// 該当するレコードのidを条件に「完了」項目の削除（nullに上書き→'未'）を実行する
	$sql = "UPDATE TODO_ITEM SET FINISHED_DATE = null WHERE ID = :id";

} else if (isset($_POST['back'])) {	// 「戻る」ボタンが押されたらlist.phpに遷移
	header("location: list.php", true, 301);
	exit;
}

$head_title = "検索結果画面";
$css_file ="list.css";
require_once("head_template.php");
?>

<body>
<h2>検索結果</h2>
<form action="search.php" method="POST">
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

// 検索結果データの読み込み

foreach ($stmt as $row) {

    if ($staff == $_SESSION['customer']['id']) {
    	echo "<div class=\"my-task\">";
    } else {
    	echo "<div class=\"others-task\">";
    }
    echo "<p>".$staff."</p>";
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