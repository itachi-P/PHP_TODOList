<?php
$head_title = "作業登録画面";
$css_file = "regist.css";
require_once('head_template.php');
?>

<body>
	<h1>作業登録</h1>
	<div class="container">
		<form action="regist_ctrl.php" method="POST">
			<div class="inputs-wrapper">
				<div class="titles">
					<ul>
						<li>項目名</li>
						<li>担当者</li>
						<li>期限</li>
					</ul>
				</div>
				<div class="inputs">
					<input class="tbox" type="text" name="subject">

					<select class="pulldown" name="staff">
						<option value="default">選択してください</option>
<?php
	// スタッフ一覧を取得
	foreach ($rows as $row) {
		echo "<option>".$row."</option>";
	}

?>				
					</select>

					<div class="terms-wrapper">
						<input class="term" type="text" name="year">
						<p>／</p>
						<input class="term" type="text" name="month">
						<p>／</p>
						<input class="term" type="text" name="day">
					</div>
				</div>	<!-- inputs(right-block) end -->
			</div> <!-- inputs-wrapper -->

			<div class="buttons-wrapper">		
				<input class="btn" type="submit" value="登録" name="regist">
				<input class="btn" type="submit" value="キャンセル" name="regist">
			</div> <!-- buttons-wrapper -->
		</form>
	</div> <!-- container -->

</body>
</html>