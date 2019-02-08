<?php
session_start();
$_SESSION['head_title'] = "<head>部テンプレ読み込みテスト";
require_once ('template.php');

?>

<body>
<h1 style="background-color: #a7c">表題１</h1>
<h2>表題２</h2>
<h3 style="background-color: #7b9">項目1</h3>
<h4>項目2</h4>
テキストボックス：<input type="text" name="text">
パスワード：<input type="password" name="password">
サブミットボタン：<input type="submit" name="submit" value="submission">

<a href="include_template.php">aタグリンク</a>

</body>
</html>