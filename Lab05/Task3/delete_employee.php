<?php
$host = 'localhost';
$user = 'root'; 
$pass = ''; 
$dbname = 'company_db';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}
$id = $_GET['id'];
$sql = "DELETE FROM employees WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Запис видалено успішно!";
} else {
    echo "Помилка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: index.php");
?>