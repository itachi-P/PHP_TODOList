<?php
// make_buttons.phpから呼び出される「操作」欄の各ボタン作成用共通関数
function makeBtn($slct_btn, $btn_value, $row) {
	$done_btn = '<input class="btn-s" type="submit" name="'.$slct_btn.'" value="'.$btn_value.'">';
/* list.phpにTODO_ITEM.IDを画面表示せず各行にhiddenで持たせる処理変更が必要
$done_btn.'<input type="hidden" name="id" value="<?= $row[\'id\'] ?>">'; */
	$done_btn.'<input type="hidden" name="subject" value="'.$row['subject'].'">';
	$done_btn.'<input type="hidden" name="'.$slct_btn.'" value="true">';
	return $done_btn;
}
?>
