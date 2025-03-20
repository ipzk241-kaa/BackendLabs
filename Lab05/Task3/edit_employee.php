<?php
$host = 'localhost';
$user = 'root'; 
$pass = ''; 
$dbname = 'company_db';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    $sql = "UPDATE employees SET name='$name', position='$position', salary=$salary WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Дані працівника оновлено успішно!";
    } else {
        echo "Помилка: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    header("Location: index.php");
} else {
    $id = $_GET['id'];
    $sql = "SELECT id, name, position, salary FROM employees WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>
    <form method="post" action="edit_employee.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        Ім'я: <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
        Посада: <input type="text" name="position" value="<?php echo $row['position']; ?>" required><br>
        Зарплата: <input type="number" step="0.01" name="salary" value="<?php echo $row['salary']; ?>" required><br>
        <input type="submit" value="Оновити дані">
    </form>
    <?php
}
?>