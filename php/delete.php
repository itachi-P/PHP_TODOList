<?php
// あくまでもレコード1行の削除「確認」画面なので、基本的にはitem_idだけをdb_ctrl.phpにスルーパスするだけのワンクッションでよい

//session_start();
$item_id = $_POST['item_id'];

$head_title = "削除確認画面";
$css_file = "regist.css";
require_once('head_template.php');
?>

<body>
	<h1>削除確認</h1>
	<p>項目ID：<?=$item_id?></p>
	<div class="container">
		<form action="db_ctrl.php" method="POST">
<h3>↓1件の項目名を表示する為だけにDB接続して検索するか、予め対象行の項目名を変数に入れPOSTで渡すか？</h3>
			<h2>項目　<?php $_POST['item_name'] ?>　を削除します。
				よろしいですか？
			</h2>

			<div class="buttons-wrapper">
				<input type="hidden" name="item_id" value="<?=$item_id?>">
				<input class="btn" type="submit" value="削除" name="delete">
				<input class="btn" type="submit" value="キャンセル" name="cancel">
			</div> <!-- buttons-wrapper -->
		</form>
	</div> <!-- container -->
</body>
</html>
