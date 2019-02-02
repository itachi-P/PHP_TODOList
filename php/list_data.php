<?php
// DB(MySQL)実装前の仮データ取得・格納場所

// ToDoListクラスの読み込み
require_once ("todolist.php");

// ToDoListクラスのインスタンスを複数生成し配列に格納
$datas = array(10);

for ($i = 0; $i < 10; $i ++) {
    $datas[$i] = new ToDoList("項目".$i, "担当者".$i, "期限".$i, "完了状態".$i);
}

//$list_datas = array('' => , );



?>