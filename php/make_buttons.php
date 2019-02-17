<?php
// 内側のforeachで最後のカラムの後に呼び出される前提で記述
// 外側のforeachで$row['done']が日付データかnullかを判別した際に後に付け加える方が確実かも？

// 1つのボタンを作る関数定義ファイルを呼び出す
// ※繰り返し呼び出されるこのファイル中で関数を定義してしまうと多重定義エラーが発生するので注意
require_once("make_button.php");

// 各ボタンで処理を分ける
if ($column == '未')	 { // or $row['done']でも同じ挙動（の筈）
	$slct_btn = "finished";
	$btn_value = "完了";
} else {
	$slct_btn = "unfinished";
	$btn_value = "未完了";
}

// どの行を指すのかを識別する為に$rowを渡す※現状は各行に一意なidを保持していないので項目名($row['subject'])がキー
// 今のままでは同じ項目名が複数存在する場合に不具合が発生するので、各行にhiddenでTODO_ITEM.IDを持たせるべき
echo makeBtn($slct_btn, $btn_value, $row);
echo makeBtn("update", "更新", $row);
echo makeBtn("delete", "削除", $row);
?>
