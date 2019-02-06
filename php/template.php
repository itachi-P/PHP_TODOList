<?php
$head_title = (isset($_SESSION['head_title'])) ? $_SESSION['head_title'] : "無題";
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset=utf-8" />
<title><?= $head_title ?></title>
<link href="../css/newDefaultStylesheet.css" rel="stylesheet" type="text/css">
</head>