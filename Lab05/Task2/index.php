
<!DOCTYPE html>
<html lang='uk'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Таблиця товарів</title>
</head>
<body>
    <h1>Таблиця товарів</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Ціна</th>
            <th>Кількість</th>
            <th>Інформація</th>
        </tr>
<?php
require 'db.php';
$sql = "SELECT * FROM tov";
$result = $pdo->query($sql);
foreach ($result as $row) {
    echo "<tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['name'] . "</td>
            <td>" . $row['cost'] . " грн</td>
            <td>" . $row['kol'] . "</td>
            <td>" . $row['info'] . "</td>
          </tr>";
}?>
</table>
    <div class='actions'>
        <form action='insert.php' method='get'>
            <input type='submit' value='Додати запис'>
        </form>
        <form action='delete.php' method='post'>
            <input type='text' name='id' placeholder='Введіть ID запису'>
            <input type='submit' value='Вилучити запис'>
        </form>
      </div>
</body>
