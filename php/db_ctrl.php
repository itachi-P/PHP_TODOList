<?php
session_start();

//各ページからのDBテーブル操作に共通して通るコントローラー
//とりあえずダミーとして何もせず一覧ページにリダイレクトする処理だけ書いておく



header("location: list.php");


?>