<?php
/* ボタンが押されたらまず自分自身にリダイレクトし、押されたボタンによって動的に遷移先を変更 */
session_start();
// ログイン状態になければログイン画面に戻す
if (empty($_SESSION['customer'])) {
	header("location: login.php", true, 301);
	exit;
}
// リスト表示画面右上に表示するログインユーザーの名前
$username = $_SESSION['customer']['name'];

// 画面遷移先情報を一旦クリア
unset($_SESSION['url']);

// 「操作」欄のボタンが押された場合、行を特定する為のIDを保持
// (※要調査) キー名に「'subject_id'を含む」「で始まる」等を条件とする正規表現は使えないか？
if (isset($_POST['subject_id'])) {
echo "###########";
echo $_POST['subject_id'];
echo $_POST['subject'];
	$_SESSION['subject_id'] = $_POST['subject_id'];
	$_SESSION['subject'] = $rows[key($rows)]['subject'];
}
//以下で押されたボタンに合わせて遷移先を切り替える(最初の画面表示時は全てスルー)
if (isset($_POST['regist'])) {
	$_SESSION['url'] = "regist.php";
} else if (isset($_POST['search'])) {
	$_SESSION['url'] = "search.php";
} else if (isset($_POST['finished'])) {
//完了ボタンが押されたら「完了」欄を「未」から現在日付に書き換え、かつ「未完了」ボタンに変える
//※「未完了」ボタンが押された時は上記の逆の操作を行う。
	$sql = "UPDATE TODO_ITEM SET FINISHED_DATE = DATE_FORMAT(now(), '%Y/%m/%d') WHERE ID = :id";

} else if (isset($_POST['unfinished'])) {
	// 該当するレコードのidを条件に「完了」項目の削除（nullに上書き→'未'）を実行する
	$sql = "UPDATE TODO_ITEM SET FINISHED_DATE = null WHERE ID = :id";

} else if(isset($_POST['update'])) {
	$_SESSION['url'] = "update.php";
} else if (isset($_POST['delete'])) {
	$_SESSION['url'] = "delete.php";
}

// 押されたボタンに応じて各画面にリダイレクト(ログイン直後の初回画面表示時はスルー)
if (isset($_SESSION['url'])) {
	header("location: ".$_SESSION['url'], true, 301);
	exit;
}


// 以下でTODOリスト一覧(全件)を表示

// PDOでMySQLに接続。 DSN:Data Source Name。hostはWindows環境では'localhost'よりIPの方が処理が速い？
$dsn = 'mysql: host=127.0.0.1; dbname=shino; charset=utf8mb4';

// 接続時のオプションを連想配列で渡す(コンストラクタの第4引数としては省略し、後でsetAttribute()で指定しても同じ)
$driver_options = array( 	// [属性名1 => 属性値1, ...]も同じ
	// エラー発生時例外を投げる (※開発時必須)
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	// エミュレートを無効(処理は高速だが脆弱性のある動的プレースホルダ→よりセキュアな静的プレースホルダ)に変更
	PDO::ATTR_EMULATE_PREPARES => false);  //ここではユーザー入力からSQL文生成する必要がないのでONでも可

$sql = "SELECT todo_item.id AS subject_id,
				todo_item.name AS subject,
				todo_user.name AS staff,
				todo_item.expire_date AS term,
				todo_item.finished_date AS done
		 FROM todo_user JOIN todo_item
		 ON todo_user.id = todo_item.user
		 ORDER BY expire_date ASC";

try {
	// DBH:データベースハンドラ ($pdoと書かれることが多い)
    $dbh = new PDO($dsn,'user1','pass1', $driver_options);

	/* (Ver.2改修予定)モードをFETCH_CLASSに変更し、DBレコード&「操作」ボタン群をオブジェクト化する
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_CLASS); */

	// ★FETCH_ASSOCとFETCH_UNIQUEを組み合わせることで、キーに整数連番でなくidが使える！★
	// 正確には先頭カラムをキー(配列の現在行のインデックス。key($rows)で取得)とし、2番目以降のカラム群を値とする配列を取得
	// →これにより、先頭カラムを一意なidにしておくことで同名項目が複数あっても処理対象の単一行を特定できる
    $rows = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_UNIQUE);

} catch (PDOException $e) {
	// エラー発生時に壊れたHTML画面ではなくプレーンテキストでエラーメッセージのみ表示
    header('Content-Type: text/plain; charset=UTF-8mb4', true, 500);
    exit($e->getMessage());
}

function hsc($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); //※mb4指定はエラー
}

$head_title = "TODO一覧";
$css_file = "list.css";
require_once("head_template.php");
?>

<body>
	<h2>作業一覧</h2>
	<h4>ようこそ <?= $username ?> さん</h4>
<!-- form actionの値を動的に変える方式だとボタン押下→即画面遷移とならず2ステップを要する変な挙動になるのでは？ -->
<!-- form actionは自分自身に固定、最上部PHP内でPOSTされた値を受け取りheader関数で直接ページ遷移方式に変更-->
	<form action="list.php" method="POST">
	<div class="middle-wrapper">
		<div class="middle-left">
			<input name="regist" class="btn-l" type="submit" value="作業登録">
		</div>
		<div class="middle-right">
			<p>検索キーワード</p>
			<input class="tbox" type="text" name="search_keyword">
			<!-- 後にinput type="submit"をtype="button"に変更しJavaScriptを組み込む -->
			<input name="search" class="btn" type="submit" value="検索">
		</div>
	</div>

	<div class="list-wrapper">
		<div class="list-header">
			<p>項目名</p>
			<p>担当者</p>
			<p>期限</p>
			<p>完了</p>
			<p>操作</p>
		</div>

		<div class="list-main">
<?php
 foreach($rows as $row) {
// 	echo key($rows); // 現在行のidを取得 ※フェッチ(ポインタ)に合わせて自動で進まないのでループ毎にnext()が必要
	// 完了状態がnullの場合「未」と表示
	$row['done'] != null ?: $row['done'] = '未';
	if ($row['staff'] === $username) {
    	echo '<div class="my-task">';
    } else {
    	echo '<div class="others-task">';
    }
	foreach ($row as $column): ?>
    		<p><?= hsc($column) ?></p>
	<?php endforeach ?>
	<!-- ここで「操作」欄のボタン群を形成 -->
	<p><?php include("make_buttons.php") ?></p>
			</div> <!-- ログインユーザー自身のタスク色分け用div -->
<?php
	// 各行を特定する為のTODO_ITEM.IDがフェッチのポインタに合わせて自動では進まないので手動で進める
	next($rows);
	} ?>

		</div> <!-- list-main-->
	</div>	<!-- list-wrapper -->
</form>

</body>
</html>