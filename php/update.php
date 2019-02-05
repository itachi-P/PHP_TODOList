<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset=utf-8" />
<title>更新画面</title>
<link href="../css/regist.css" rel="stylesheet" type="text/css">
</head>
<body>
	<h2>作業更新</h2>
	<div class="container">
		<form action="registCtrl.php" method="get">
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
	require_once('list_data.php');
	foreach ($datas as $data) {
		echo "<option>".$data->getStaff()."</option>";
	}

?>				
					</select>

					<div class="terms-wrapper">
						<input class="term" type="text" name="year">
						<p>／</p>
						<input class="term" type="text" name="month">
						<p>／</p>
						<input class="term" type="text" name="day">
						<input class="finished" type="checkbox">
						<p>完了した</p>
					</div>
				</div>	<!-- inputs(right-block) end -->
			</div> <!-- inputs-wrapper -->

			<div class="buttons-wrapper">		
				<input class="btn" type="submit" value="更新" name="regist">
				<input class="btn" type="submit" value="キャンセル" name="regist">
			</div> <!-- buttons-wrapper -->
		</form>
	</div> <!-- container -->

</body>
</html>