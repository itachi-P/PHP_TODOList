<!-- ここで「操作」欄のボタン群を形成 -->
	<p><form action="#" method="POST">
<!--	<button type="submit" name="finished">完了</button> -->
	<button type="submit" name="finished">完了</button>
	<input type="hidden" name="subject" value="項目08">
	<input type="hidden" name="finished" value="true">
</form>

<!-- 以下のフォームも全て上のPHP内で共通部分にaction,name,ラベルだけを変える変数を埋め込んで成形可能 -->
<form action="update.php" method="POST">
	<button type="submit" name="update">更新</button>
	<input type="hidden" name="update" value="true">
</form>

<form action="delete.php" method="POST">
	<button type="submit" name="delete">削除</button>
	<input type="hidden" name="delete" value="true">
</form>
</p>