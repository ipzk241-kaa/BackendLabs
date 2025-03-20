<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управління працівниками</title>
</head>
<body>
    <h1>Управління працівниками</h1>

    <h2>Додати нового працівника</h2>
    <form method="post" action="add_employee.php">
        Ім'я: <input type="text" name="name" required><br>
        Посада: <input type="text" name="position" required><br>
        Зарплата: <input type="number" step="0.01" name="salary" required><br>
        <input type="submit" value="Додати працівника">
    </form>

    <h2>Список працівників</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Ім'я</th>
            <th>Посада</th>
            <th>Зарплата</th>
            <th>Дії</th>
        </tr>
        <?php
        $host = 'localhost';
        $user = 'root'; 
        $pass = ''; 
        $dbname = 'company_db';
        
        $conn = new mysqli($host, $user, $pass, $dbname);
        
        if ($conn->connect_error) {
            die("Помилка підключення: " . $conn->connect_error);
        }

        $sql = "SELECT id, name, position, salary FROM employees";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["position"] . "</td>
                        <td>" . $row["salary"] . "</td>
                        <td>
                            <a href='edit_employee.php?id=" . $row["id"] . "'>Редагувати</a> | 
                            <a href='delete_employee.php?id=" . $row["id"] . "' onclick='return confirm(\"Ви впевнені?\")'>Видалити</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Немає даних</td></tr>";
        }

        $conn->close();
        ?>
    </table>

    <div class="statistics">
        <h2>Статистика</h2>
        <?php
        $conn = new mysqli($host, $user, $pass, $dbname);

        $sql = "SELECT AVG(salary) AS avg_salary FROM employees";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo "<p><strong>Середня зарплата:</strong> " . number_format($row['avg_salary'], 2) . "</p>";

        $sql = "SELECT position, COUNT(*) AS count FROM employees GROUP BY position";
        $result = $conn->query($sql);
        echo "<h3>Кількість працівників на посаді:</h3>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row['position'] . ": " . $row['count'] . "</li>";
        }
        echo "</ul>";

        $conn->close();
        ?>
    </div>
</body>
</html>