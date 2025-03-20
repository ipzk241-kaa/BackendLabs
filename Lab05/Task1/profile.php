<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT username, email, first_name, last_name, birth_date, gender, phone, address FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $stmt = $pdo->prepare("SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?");
    $stmt->execute([$username, $email, $user_id]);

    if ($stmt->fetch()) {
        echo "Логін або email вже зайнятий іншим користувачем.";
        exit;
    }

    $stmt = $pdo->prepare("UPDATE users SET 
        username = ?, email = ?, first_name = ?, last_name = ?, birth_date = ?, gender = ?, 
        phone = ?, address = ? WHERE id = ?");
    $stmt->execute([$username, $email, $first_name, $last_name, $birth_date, $gender, $phone, $address, $user_id]);

    if (!empty($new_password)) {
        if ($new_password !== $confirm_password) {
            echo "Паролі не співпадають.";
            exit;
        }
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$hashed_password, $user_id]);
    }

    echo "Дані оновлено!";
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагування профілю</title>
</head>
<body>
    <h2>Редагування профілю</h2>
    <form action="profile.php" method="POST">
        <label for="username">Логін:</label>
        <input type="text" name="username" value="<?= isset($user['username']) ? htmlspecialchars($user['username']) : '' ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= isset($user['email']) ? htmlspecialchars($user['email']) : '' ?>" required>
        <br>
        <label for="first_name">Ім'я:</label>
        <input type="text" name="first_name" value="<?= isset($user['first_name']) ? htmlspecialchars($user['first_name']) : '' ?>">
        <br>
        <label for="last_name">Прізвище:</label>
        <input type="text" name="last_name" value="<?= isset($user['last_name']) ? htmlspecialchars($user['last_name']) : '' ?>">
        <br>
        <label for="birth_date">Дата народження:</label>
        <input type="date" name="birth_date" value="<?= isset($user['birth_date']) ? htmlspecialchars($user['birth_date']) : '' ?>">
        <br>
        <label for="phone">Телефон:</label>
        <input type="text" name="phone" value="<?= isset($user['phone']) ? htmlspecialchars($user['phone']) : '' ?>">
        <br>
        <label for="address">Адреса:</label>
        <textarea name="address"><?= isset($user['address']) ? htmlspecialchars($user['address']) : '' ?></textarea>
        <br>
        <label for="gender">Стать:</label>
        <select name="gender">
            <option value="male" <?= isset($user['gender']) && $user['gender'] == 'male' ? 'selected' : '' ?>>Чоловік</option>
            <option value="female" <?= isset($user['gender']) && $user['gender'] == 'female' ? 'selected' : '' ?>>Жінка</option>
            <option value="other" <?= isset($user['gender']) && $user['gender'] == 'orher' ? 'selected' : '' ?>>Інший</option>
        </select>
        <br>
        <label for="new_password">Новий пароль (необов'язково):</label>
        <input type="password" name="new_password">
        <br>
        <label for="confirm_password">Підтвердити пароль:</label>
        <input type="password" name="confirm_password">
        <br>
        <button type="submit">Зберегти зміни</button>
    </form>

    <form action="delete_account.php" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити акаунт?');">
        <button type="submit" name="delete">Видалити акаунт</button>
    </form>
</body>
</html>