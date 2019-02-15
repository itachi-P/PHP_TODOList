<?php
session_start();

//自分自身にリダイレクトし、押されたボタンによってform actionの中身を動的に変えて遷移先を変更
//初期値(最初の1回は自分自身のページにリダイレクト)
if (!isset($_SESSION['url'])) {
	//この条件分岐は不要で else以下の処理だけでいいのでは？
	$_SESSION['url'] = "list.php";
} else {
	//以下で押されたボタンに合わせて遷移先を切り替える(最初の画面表示時は処理されない)
	//一応以下のやり方で画面遷移は切り分けられるものの、ホントにこんな冗長な書き方しか無いのか？
	unset($_SESSION['url']);

	if (isset($_POST['regist'])) {
		$_SESSION['url'] = "regist.php";
	}
	//検索条件を元に検索をかけた結果画面に遷移
	if (isset($_POST['search'])) {
		$_SESSION['url'] = "search_result.php";
	} else if (isset($_POST['finish'])) {
		//（仮）
		//完了ボタンが押されたら「完了」欄を「未」から現在日付に書き換え「未完了」ボタンにラベルを変える
		//※「未完了」ボタンを押した時の処理はまた別に記述
		if ($_POST['finish'] == "完了") {

		}
		echo "<b>".$_POST['finish']."</b>";
	} else if(isset($_POST['update'])) {
		$_SESSION['url'] = "update.php";
	} else if (isset($_POST['delete'])) {
		$_SESSION['url'] = "delete.php";
	}

	if (isset($_SESSION['url'])) {
		header("location: ".$_SESSION['url']);
	}
}

// TODOリスト一覧(全件)を表示
$dsn = 'mysql: host=localhost; dbname=shino; charset=utf8mb4';
try {
    $pdo = new PDO($dsn,'user1','pass1');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rows = $pdo->query("SELECT todo_item.name AS subject,
    							todo_user.name AS username,
    							todo_item.expire_date AS term,
    							todo_item.finished_date AS done
	    				 FROM todo_user JOIN todo_item
	    				 ON todo_user.id = todo_item.user
	    				 ORDER BY expire_date ASC")
    				->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8mb4', true, 500);
    exit($e->getMessage());
}

function hsc($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$head_title = "TODO一覧";
$css_file = "list.css";
require_once("head_template.php");
?>

<body>
	<h2>作業一覧</h2>
	<h4>ようこそ <?= $_SESSION['username'] ?> さん</h4>
<!-- form actionの値を動的に変える方式だとボタン押下→即画面遷移とならず変な挙動になるのでは？ -->
<!--form action="<?= $_SESSION['url'] ?>" method="POST" -->
<!-- form actionは自分自身に固定、POSTされた値を受け取ったPHP部分で直接ページ遷移方式に変更-->
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
	// 完了状態がnullの場合「未」と表示
	$row['done'] != null ?: $row['done'] = '未';
	 foreach ($row as $column): ?>
    		<p><?= $column ?></p>
  <?php endforeach ?>

<?php } ?>

		</div> <!-- list-main-->
	</div>	<!-- list-wrapper -->
</form>

</body>
</html>