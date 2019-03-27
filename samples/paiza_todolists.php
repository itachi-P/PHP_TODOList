<?php
    //For Heroku
    $url = parse_url(getenv('CLEARDB_DATABASE_URL'));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $pdo = new PDO(
      'mysql:host=' . $server . ';dbname=' . $db . ';charset=utf8mb4',
      $username,
      $password,
      [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
      ]
    );

    if(isset($_POST['submit']) ){
        $name = $_POST['name'];
        $sth = $pdo->prepare("INSERT INTO paiza_todos (name) VALUES (:name)");
        $sth->bindValue(':name', $name, PDO::PARAM_STR);
        $sth->execute();
    }elseif(isset($_POST['delete'])){
        $id = $_POST['id'];
        $sth = $pdo->prepare("delete from paiza_todos where id = :id");
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
    }
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
    <title>Todo List</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
    <link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
</head>

<body class="container">
    <h1>Todo List</h1>
    <form method="post" action="">
        <input type="text" name="name" value="" required>
        <input type="submit" name="submit" value="Add">
    </form>
    <h2>Current Todos</h2>
    <table class="table table-striped">
        <therad><th>Task</th><th></th></therad>
        <tbody>
<?php
    $sth = $pdo->prepare("SELECT * FROM paiza_todos ORDER BY id DESC");
    $sth->execute();
    
    foreach($sth as $row) {
?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td>
                    <form method="POST">
                        <button type="submit" name="delete">Delete</button>
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="delete" value="true">
                    </form>
                </td>
            </tr>
<?php
    }
?>
        </tbody>
    </table>
</body>
</html>