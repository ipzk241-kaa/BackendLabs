<?php
$fontSize = isset($_COOKIE['font_size']) ? $_COOKIE['font_size'] : '16px';
$file1 = 'file1.txt';
$file2 = 'file2.txt';

function readWords($file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        return explode(' ', $content);
    }
    return [];
}

$words1 = readWords($file1);
$words2 = readWords($file2);

$onlyInFile1 = array_diff($words1, $words2); 
$inBothFiles = array_intersect($words1, $words2); 
$mas1 = array_filter(array_count_values($words1), function($count) {
    return $count >= 2;
});
$mas2 = array_filter(array_count_values($words2), function($count) {
    return $count >= 2;
});

$moreThanTwo = array_merge(array_keys($mas1),array_keys( $mas2));

file_put_contents('only_in_file1.txt', implode(' ', $onlyInFile1));
file_put_contents('in_both_files.txt', implode(' ', $inBothFiles));
file_put_contents('more_than_two.txt', implode(' ', $moreThanTwo));

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filename'])) {
    $filename = $_POST['filename'];
    if (file_exists($filename)) {
        unlink($filename);
        echo "Файл $filename видалено.";
    } else {
        echo "Файл $filename не знайдено.";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Робота з файлами</title>
    <style>
        body {
            font-size: <?php echo htmlspecialchars($fontSize); ?>;
        }
    </style>
</head>
<body>
    <h1>Видалити файл</h1>
    <form method="POST" action="">
        <label for="filename">Введіть ім'я файлу:</label>
        <input type="text" name="filename" id="filename" required>
        <button type="submit">Видалити</button>
    </form>
</body>
</html>