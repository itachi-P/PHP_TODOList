<?php
// make_buttons.phpから呼び出される「操作」欄の各ボタン作成用共通関数
function makeBtn($slct_btn, $btn_value, $rows) {
	$done_btn = '<input class="btn-s" type="submit" name="'.$slct_btn.'" value="'.$btn_value.'">';
	// ボタンが押された単一行を特定する一意なid(配列の添字キー)、及び処理内容をhiddenで渡す
// ※(要修正) ボタン押下時hiddenが最後の値で上書きされ、無条件で最終行に指定されてしまう・・・
	$done_btn.='<input type="hidden" name=subject_id'.key($rows).' value="'.$rows[key($rows)]['subject'].'">';
	// submitとhiddenで同じnameが2つになるとボタン押しても画面遷移しない模様。そもそも不要っぽい
	//$done_btn.='<input type="hidden" name="'.$slct_btn.key($rows).'" value="true">';
	return $done_btn;
}
?>
