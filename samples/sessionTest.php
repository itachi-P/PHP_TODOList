<?php
  session_start();
  if ( empty( $_SESSION[ 'count' ] ) )  $_SESSION[ 'count' ] = 0;
  if ( isset( $_POST[ 'inc' ] ) )  $_SESSION[ 'count' ]++;    // 増やす
  if ( isset( $_POST[ 'dec' ] ) )  $_SESSION[ 'count' ]--;    // 減らす
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
                      "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <title>セッションの開始と終了</title>
  </head>
  <body>
    <h4>セッションの開始と終了</h4>
<?php
    echo 'カウンタ : ' . $_SESSION[ 'count' ];    // カウンタの値
?>
    <form method="post" action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>">
      <div>
        <input type="submit" name="inc" value="増やす">
        <input type="submit" name="dec" value="減らす">
      </div>
    </form>
  </body>
</html>