<?php
// DB(MySQL)実装前の仮データ取得・格納場所

// ToDoListクラスの読み込み
require_once ("todolist.php");

// ToDoListクラスのインスタンスを複数生成し配列に格納
$datas = array(10);

$term = date("Y/m/t");
$finished;

for ($i = 0; $i < 10; $i ++) {
	if ($i % 3 == 0) {
		$finished = date("Y/m/d H:i:s");    		
    } else {
    	$finished = "未";
    }
    $datas[$i] = new ToDoList("項目".$i, "担当者".$i, $term, $finished);
}


?>