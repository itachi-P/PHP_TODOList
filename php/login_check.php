<?php
// リクエストから得たスーパーグローバル変数のチェック処理
$userID = $_POST['userID'];
$pass = $_POST['password'];

// (追記予定) ここで入力値に対しバリデーションまたはサニタイズ処理を記述
// if ($userID ...) {}
// if ($pass ...) {}

// 入力されたユーザーID、パスワードのDB照合
$dsn = 'mysql: host=localhost; dbname=shino; charset=utf8mb4';
try {
    $pdo = new PDO($dsn, 'user1', 'pass1');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // ユーザーからの入力値を元にSQLを形成する場合エミュレーションをOFFにした方が安全
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // 疑問符プレースホルダ使用パターン ※名前付きプレースホルダ(:id, :password)との混在はエラー
    $sql = "SELECT ID, NAME, PASSWORD
	    	FROM todo_user
	    	WHERE ID = ? AND PASSWORD = ?";
	$stmt = $pdo -> prepare($sql);
	$stmt->bindValue(1, $userID, PDO::PARAM_STR); 
	$stmt->bindValue(2, $pass); // 第3引数 PDO::PARAM_STRは省略可能(PDO::PARAM_INTは明示が必要)
	$stmt->execute();
} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}

// とりあえずユーザーIDかパスワードどちらか一方が合っている場合の切り分けは考えず処理する
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row != null) {
	// ログイン成功
	$url = "list.php";
	//セッション開始
	session_start();
	//このページを介さずにlogin.phpで直接セッション開始→一覧画面へ遷移、に修正予定
	$_SESSION['userid'] = $row['ID'];
	$_SESSION['username'] = $row['NAME'];
} else {
	// ユーザーID及びパスワードの組み合わせがDBに存在しない場合
	$url = "error.php?err=login_failed";
}
/* 開発時用確認出力 2通り (本番環境リリース前にいずれも要削除、かつ確認時は下部のheaderをコメントアウト)
printf("ID:%s PASSWORD:%s NAME:%s<br />\n", $row['ID'], $row['PASSWORD'], $row['NAME']);
print_r($row);
*/
//一瞬で自動遷移なのでユーザーが実際にこの画面を見ることは無いが、このページ自体が要らんワンクッションかな?
header("location: ".$url, true, 301);
exit;
?>
