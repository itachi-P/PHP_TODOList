<?php
/* リスト画面の「操作」欄のボタン群を生成する
	内側のforeachで各行の最後のカラム($rows['done']出力)の直後に呼び出される前提で記述 */

// 「操作」欄の1つのボタン(複数のhiddenも含む)を作る関数　どの行を指すのか一意なidによって特定する為に$rowsも渡す
function makeBtn($action, $btn_value, $rows) {
	// 「操作」欄に表示されるボタン1個のHTMLを生成する
	$done_btn = "";
	$action_url = "";

	if ($action === "finished" || $action === "unfinished") {
		$action_url = "#";
	} else {
		$action_url = $action.".php";
	}

// 1つのボタンにつき1つの<form action>＋操作内容＋対象行を特定する為のidをhiddenで送信
	$done_btn =	'<form action="'.$action_url.'" method="POST">';
	$done_btn.= '<input type="hidden" name="action" value="'.$action.'">';
	$done_btn.= '<input type="hidden" name="item_id" value="'.key($rows).'">';
	$done_btn.= '<td class="done_btns">';
	$done_btn.= '<input class="btn-s" type="submit" name="'.$action.'" value="'.$btn_value.'">';
	$done_btn.= '</td>';
	$done_btn.= '</form>';
	return $done_btn;
}

// makeBtnのラッパー関数
function makeBtns($rows) {
	// 直前の「完了」欄が日付データかnullかで「操作」欄の1つ目のボタンを変える
	if ($rows[key($rows)]['done'] === null) {
		$action = "finished";
		$btn_value = "完了";
	} else {
		$action = "unfinished";
		$btn_value = "未完了";
	}
	echo makeBtn($action, $btn_value, $rows);
	echo makeBtn("update", "更新", $rows);
	echo makeBtn("delete", "削除", $rows);
}
?>
