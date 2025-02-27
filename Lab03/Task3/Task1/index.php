<?php
$fontSize = isset($_COOKIE['font_size']) ? $_COOKIE['font_size'] : '16px';
function readComments($file) {
    if (file_exists($file)) {
        $comments = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return $comments;
    }
    return [];
}

function addComment($file, $name, $comment) {
    $comment = str_replace("\n", "<br>", $comment);
    $data = "$name|$comment\n";
    file_put_contents($file, $data, FILE_APPEND);
}

$file = 'comments.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) && isset($_POST['comment'])) {
        $name = htmlspecialchars($_POST['name']);
        $comment = htmlspecialchars($_POST['comment']);
        addComment($file, $name, $comment);
    }
}

$comments = readComments($file);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Коментарі</title>
    <style>
        body {
            font-size: <?php echo htmlspecialchars($fontSize); ?>;
        }
    </style>
</head>
<body>
    <h1>Додати коментар</h1>
    <form method="POST" action="">
        <label for="name">Ім'я:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <br>
        <label for="comment">Коментар:</label>
        <textarea name="comment" id="comment" required></textarea>
        <br>
        <button type="submit">Відправити</button>
    </form>

    <h2>Поточні коментарі</h2>
    <table border="1">
        <tr>
            <th>Ім'я</th>
            <th>Коментар</th>
        </tr>
        <?php foreach ($comments as $comment): ?>
            <?php list($name, $text) = explode('|', $comment); ?>
            <tr>
                <td><?php echo $name; ?></td>
                <td><?php echo $text; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>