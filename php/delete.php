<?php
//session_start();

$head_title = "削除確認画面";
$css_file = "regist.css";
require_once('head_template.php');
?>

<body>
	<h1>削除確認</h1>
	<p>項目ID：<?= $_POST['item_id'] ?></p>
	<div class="container">
		<form action="db_ctrl.php" method="get">
<h3>↓1件の項目名を表示する為だけにDB接続して検索するか、リスト画面の項目名をなんらかの変数に入れて渡すか？</h3>
			<h2>項目　<?php $_POST['item_name'] ?>　を削除します。
				よろしいですか？
			</h2>

			<div class="buttons-wrapper">
				<input class="btn" type="submit" value="削除" name="delete">
				<input class="btn" type="submit" value="キャンセル" name="cancel">
			</div> <!-- buttons-wrapper -->
		</form>
	</div> <!-- container -->
</body>
</html>
