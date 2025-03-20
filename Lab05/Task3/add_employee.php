<?php
$host = 'localhost';
$user = 'root'; 
$pass = ''; 
$dbname = 'company_db';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}

$name = $_POST['name'];
$position = $_POST['position'];
$salary = $_POST['salary'];

$sql = "INSERT INTO employees (name, position, salary) VALUES ('$name', '$position', $salary)";

if ($conn->query($sql) === TRUE) {
    echo "Нового працівника додано успішно!";
} else {
    echo "Помилка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: index.php");
?>