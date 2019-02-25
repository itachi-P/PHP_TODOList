<?php
/* このページを介さずにlogin.phpで直接DB照合→セッション開始→一覧画面へ遷移、に修正予定 */

// まず先に存在する(ブラウザを閉じても前回から残っている)セッションを解放
//$_SESSION = array();
//session_destroy();
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
    // 開発時は例外を投げる設定が必須
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // ユーザーからの入力値を元にSQLを形成する場合エミュレーションをOFFにした方がセキュリティ上安全
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // 疑問符プレースホルダ使用パターン ※名前付きプレースホルダ(:id, :password)との混在はエラー
    $sql = "SELECT ID, NAME, PASSWORD
	    	FROM TODO_USER
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
// ※入力されたIDとパスワードの組み合わせに該当するレコードが1件しか無い前提で1回だけのfetch()
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row != null) {
	// ログイン成功
	$url = "list.php";
	//セッション開始
	session_start();
	$_SESSION['customer'] = array(
		'id' => $row['ID'],
		'name' => $row['NAME']
	);
} else {
	// ユーザーID及びパスワードの組み合わせがDBに存在しない場合
	$url = "error.php?err=login_failed";
}
/* 開発時用配列確認出力 3通り (本番環境リリース前にいずれも要削除、かつ確認時は下部のheaderをコメントアウト)
printf("ID:%s PASSWORD:%s NAME:%s<br />\n", $row['ID'], $row['PASSWORD'], $row['NAME']);
echo "<pre>";	// 囲まれた範囲のソースに記述されたスペース・改行などをそのまま表示するタグ
echo "print_r: 配列の中身をkeyとvalueの連想配列としてシンプルに表示<br>";
print_r($row);
echo "<br>var_dump: 配列情報を詳細に表示<br>";
var_dump($row);
echo "</pre>";
*/

//一瞬で自動遷移なのでユーザーが実際にこの画面を見ることは無いが、このページ自体が要らんワンクッションかな?
header("location: ".$url, true, 301);
exit;
?>
