<?php
session_start();
$head_title = "更新画面";
$css_file = "regist.css";
require_once('head_template.php');
?>
<body>
	<h1>作業更新</h1>
	<p>作業項目ID:<?=$_SESSION['subject_id']?></p>
	<div class="container">
		<form action="regist_ctrl.php" method="get">
			<div class="inputs-wrapper">
				<div class="titles">
					<ul>
						<li>項目名</li>
						<li>担当者</li>
						<li>期限</li>
						<li>完了</li>
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
					<div class="chkbox-wrapper">
						<input class="chkbox" type="checkbox" name="finished_chk">完了した
					</div>
				</div>	<!-- inputs(right-block) end -->
			</div> <!-- inputs-wrapper -->

			<div class="buttons-wrapper">		
				<input class="btn" type="submit" value="更新" name="update">
				<input class="btn" type="submit" value="キャンセル" name="update">
			</div> <!-- buttons-wrapper -->
		</form>
	</div> <!-- container -->

</body>
</html>