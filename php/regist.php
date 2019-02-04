<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset=utf-8" />
<title>作業登録画面</title>
<link href="../css/stylesheet.css" rel="stylesheet" type="text/css">
<link href="../css/regist.css" rel="stylesheet" type="text/css">
</head>
<body>
	<h2>作業登録</h2>
	<!-- <hr>タグをやめて上の文字列ブロック要素のborderで指定 -->

	<div class="container">
		<form action="registCtrl.php" method="post">
			<div class="inputs-wrapper">
				<p>項目名</p>
				<input class="tbox" type="text" name="subject">
				<p>担当者</p>
				<select class="pulldown" name="staff">
					<option value="default">選択してください</option>
<?php


?>				
				</select>
				<p>期限</p>
				<div class="terms-wrapper">
					<input class="term" type="text" name="year">
					<input class="term" type="text" name="month">
					<input class="term" type="text" name="day">
				</div>
			</div> <!-- inputs-wrapper -->

			<div class="buttons-wrapper">		
				<!-- input type="submit" and "reset" -->
				<input class="btn" type="submit" value="登録">
				<input class="btn" type="reset" value="キャンセル">
			</div> <!-- buttons-wrapper -->
		</form>
	</div> <!-- container -->

<?php