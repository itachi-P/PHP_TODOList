<?php
// プルダウンリストのデフォルト表示(selected)をログインユーザーにする為にセッション利用
session_start();
// ログインユーザーの名前
$guestname = $_SESSION['customer']['name'];

// この画面が直接表示された場合エラー画面に飛ばす
if (empty($_POST['action'])) {
	$url = "error.php?err=unauthorized_access";
	header("location: ".$url, true, 301);
	exit;
}

$dsn = 'mysql: host=127.0.0.1; dbname=shino; charset=utf8mb4';
$driver_options = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_EMULATE_PREPARES => false,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	];

try {
    $pdo = new PDO($dsn,'user1','pass1', $driver_options);

    // プルダウンリスト用に担当者一覧を取得
    $sql = "SELECT name FROM todo_user";
    $staffs = $pdo->query($sql)->fetchAll();
    //print_r($staffs);

} catch (PDOException $e) {
	// エラー発生時に壊れたHTML画面ではなくプレーンテキストでエラーメッセージのみ表示
    header('Content-Type: text/plain; charset=UTF-8mb4', true, 500);
    exit($e->getMessage());
}

function hsc($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); //※mb4指定はエラー
}

$head_title = "作業登録画面";
$css_file = "regist.css";
require_once('head_template.php');
?>
<body>
	<h1>作業登録</h1>
	<div class="container">
		<form action="db_ctrl.php" method="POST">
			<div class="inputs-wrapper">
				<div class="titles">
					<ul>
						<li>項目名</li>
						<li>担当者</li>
						<li>期限</li>
					</ul>
				</div>
				<div class="inputs">
					<input class="tbox" type="text" name="item_name">

					<select class="pulldown" name="user_name">
<?php foreach ($staffs as $staff):$selected = ($staff['name'] === $guestname)? 'selected="selected"' : ''; ?>
						<option value="<?=$staff['name'].'" '.$selected?>">
							<?=hsc($staff['name'])?>
						</option>
<?php endforeach ?>
					</select>

					<div class="terms-wrapper">
						<input class="term" type="text" name="year">
						<p>／</p>
						<input class="term" type="text" name="month">
						<p>／</p>
						<input class="term" type="text" name="day">
					</div>
				</div>	<!-- inputs(right-block) end -->
			</div> <!-- inputs-wrapper -->

			<div class="buttons-wrapper">
<!-- ボタンごとにformを分けhiddenにactionを持たせる仕様に書き換えず、db_ctrl.php側で登録かキャンセル処理かを判別する -->
				<input class="btn" type="submit" value="登録" name="regist">
				<input class="btn" type="submit" value="キャンセル" name="cancel">
			</div> <!-- buttons-wrapper -->
		</form>
	</div> <!-- container -->

</body>
</html>
