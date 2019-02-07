<?php
//ログ出力ini_set()
ini_set('log_errors','on');  //ログを取るか
ini_set('error_log','DQB.log');  //ログの出力ファイルを指定
//セッション開始
session_start(); //セッションを使う

// 自分のHP
//定数の設定 define()
define("MY_HP", 500);
// モンスター達格納用
$monsters = array();

$monsters[] = array(
  'name' => 'フランケン',
  'hp' => 100,
  'img' => 'img/monster01.png',
  //mt_rand()
  'attack' => mt_rand(20, 40)
);
$monsters[] = array(
  'name' => 'フランケンNEO',
  'hp' => 300,
  'img' => 'img/monster02.png',
  'attack' => mt_rand(20, 60)
);
$monsters[] = array(
  'name' => 'ドラキュリー',
  'hp' => 200,
  'img' => 'img/monster03.png',
  'attack' => mt_rand(30, 50)
);
$monsters[] = array(
  'name' => 'ドラキュリー男爵',
  'hp' => 400,
  'img' => 'img/monster04.png',
  'attack' => mt_rand(50, 100)
);
$monsters[] = array(
  'name' => 'スカルフェイス',
  'hp' => 150,
  'img' => 'img/monster05.png',
  'attack' => mt_rand(30, 60)
);
$monsters[] = array(
  'name' => '毒ハンド',
  'hp' => 100,
  'img' => 'img/monster06.png',
  'attack' => mt_rand(10, 30)
);
$monsters[] = array(
  'name' => '泥ハンド',
  'hp' => 120,
  'img' => 'img/monster07.png',
  'attack' => mt_rand(20, 30)
);
$monsters[] = array(
  'name' => '血のハンド',
  'hp' => 180,
  'img' => 'img/monster08.png',
  'attack' => mt_rand(30, 50)
);

function createMonster(){
	//global変数
  global $monsters;
  $viewMonster = $monsters[mt_rand(0, 7)];
  //unset($_SESSION[])
  unset($_SESSION['name']);
  unset($_SESSION['hp']);
  unset($_SESSION['img']);
  $_SESSION['name'] = $viewMonster['name'];
  $_SESSION['hp'] = $viewMonster['hp'];
  $_SESSION['img'] = $viewMonster['img'];
  $_SESSION['attack'] = $viewMonster['attack'];
  //画面内に蓄積表示する経過記録（ログ）
  $_SESSION['history'] .= $_SESSION['name'].'が現れた！<br>';
}
function init(){
  $_SESSION['history'] .= '初期化します！<br>';
  $_SESSION['knockDownCount'] = 0;
  //固定値(定数)の代入による初期化
  $_SESSION['myhp'] = MY_HP;
  createMonster();
}
function gameOver(){
	//セッションの初期化
  $_SESSION = array();
}


//1.post送信されていた場合
if(!empty($_POST)){
	//(条件式) ? 式A : 式B →　条件式がtrueならA, falseならB
  $attackFlg = (!empty($_POST['attack'])) ? true : false;
  $startFlg = (!empty($_POST['start'])) ? true : false;
  //外部ファイルのログに追記(エラーでなくてもよい)
  error_log('POSTされた！');
  
  if($startFlg){
    $_SESSION['history'] = 'ゲームスタート！<br>';
    init();
  }else{
    // 攻撃するを押した場合
    if($attackFlg){
      $_SESSION['history'] .= '攻撃した！<br>';
      
      // ランダムでモンスターに攻撃を与える
      $attackPoint = mt_rand(50,100);
      $_SESSION['hp'] -= $attackPoint;
      $_SESSION['history'] .= $attackPoint.'ポイントのダメージを与えた！<br>';
      // モンスターから攻撃を受ける
      $_SESSION['myhp'] -= $_SESSION['attack'];
      $_SESSION['history'] .= $_SESSION['attack'].'ポイントのダメージを受けた！<br>';
      
      // 自分のhpが0以下になったらゲームオーバー
      if($_SESSION['myhp'] <= 0){
        gameOver();
      }else{
        // hpが0以下になったら、別のモンスターを出現させる
        if($_SESSION['hp'] <= 0){
          $_SESSION['history'] .= $_SESSION['name'].'を倒した！<br>';
          createMonster();
          $_SESSION['knockDownCount'] = $_SESSION['knockDownCount']+1;
        }
      }
    }else{ //逃げるを押した場合
      $_SESSION['history'] .= '逃げた！<br>';
      createMonster();
    }
  }
  //処理の最後にはPOSTの中身も初期化する
  $_POST = array();
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ホームページのタイトル</title>
    <!-- 外部スタイルシートふ(.css)を別途用意せずに<head>内で定義 -->
    <style>
    	body{
	    	margin: 0 auto;
	    	padding: 150px;
	    	width: 25%;
	    	background: #fbfbfa;
        color: white;
    	}
    	h1{ color: white; font-size: 20px; text-align: center;}
      h2{ color: white; font-size: 16px; text-align: center;}
    	
    	/* formにスタイルシートでoverflow: hidden; */
    	form{
	    	overflow: hidden;
    	}
    	/* inputタグのタイプごとのスタイルシート指定 */
    	input[type="text"]{
    		color: #545454;
	    	height: 60px;
	    	width: 100%;
	    	padding: 5px 10px;
	    	font-size: 16px;
	    	display: block;
	    	margin-bottom: 10px;
	    	box-sizing: border-box;
    	}
      	input[type="password"]{
    		color: #545454;
	    	height: 60px;
	    	width: 100%;
	    	padding: 5px 10px;
	    	font-size: 16px;
	    	display: block;
	    	margin-bottom: 10px;
	    	box-sizing: border-box;
    	}
    	input[type="submit"]{
	    	border: none;
	    	padding: 15px 30px;
	    	margin-bottom: 15px;
	    	background: black;
	    	color: white;
	    	float: right;
    	}
    	input[type="submit"]:hover{
	    	background: #3d3938;
	    	cursor: pointer;
    	}
    	a{
	    	color: #545454;
	    	display: block;
    	}
    	a:hover{
	    	text-decoration: none;
    	}
    </style>
  </head>

  <body>
  	<!-- HTML内の各行でタグごとのstyle属性でもスタイルシート指定 -->
   <h1 style="text-align:center; color:#333;">ゲーム「ドラ◯エ!!」</h1>
    <div style="background:black; padding:15px; position:relative;">
    	<!-- 最初の画面表示時はSESSINが空の状態→スタート画面を表示 -->
      <?php if(empty($_SESSION)){ ?>
        <h2 style="margin-top:60px;">GAME START ?</h2>
        <form method="post">
        	<!-- $_POSTのキー'start'をトリガーとして渡す(valueの中身は空じゃなければ何でもいい) -->
          <input type="submit" name="start" value="▶ゲームスタート">
        </form>
      <?php }else{ ?>
        <h2><?php echo $_SESSION['name'].'が現れた!!'; ?></h2>
        <div style="height: 150px;">
          <img src="<?php echo $_SESSION['img']; ?>" style="width:120px; height:auto; margin:40px auto 0 auto; display:block;">
        </div>
        <p style="font-size:14px; text-align:center;">モンスターのHP：<?php echo $_SESSION['hp']; ?></p>
        <p>倒したモンスター数：<?php echo $_SESSION['knockDownCount']; ?></p>
        <p>勇者の残りHP：<?php echo $_SESSION['myhp']; ?></p>
        <form method="post">
        <!-- POSTで各nameを渡すことで次の処理を切り分ける(valueの中身は空でなければ何でもよい) -->
          <input type="submit" name="attack" value="▶攻撃する">
          <input type="submit" name="escape" value="▶逃げる">
          <input type="submit" name="start" value="▶ゲームリスタート">
        </form>
      <?php } ?>
      <!-- 画面右側の固定位置に戦闘状況のログを蓄積表示 -->
      <div style="position:absolute; right:-300px; top:0; color:black; width: 250px;">
      	<!-- ログが空っぽ(null?)なら''(空文字列)で初期化、そうでなければセッションに追記 -->
        <p><?php echo (!empty($_SESSION['history'])) ? $_SESSION['history'] : ''; ?></p>
      </div>
    </div>
    
  </body>
</html>
