<?php
try {
    $pdo = new PDO('mysql: host=localhost; dbname=shino; charset=utf8','user1','pass1', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $rows = $pdo->query('SELECT * FROM todolist')->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}

function hsc($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>DB接続サンプル</title>
        <style type="text/css">
            table, td, th {
                border: solid black 1px;
            }
            table {
                width: 70%;
            }
        </style>
    </head>
    <body>
        <table>
<?php foreach ($rows as $row): ?>
            <tr>
  <?php foreach ($row as $column): ?>
                <td><?=hsc($column)?></td>
  <?php endforeach; ?>
            </tr>
<?php endforeach; ?>
        </table>
    </body>
</html>
