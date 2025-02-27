<?php
$file = 'words.txt';

if (file_exists($file)) {
    $words = file_get_contents($file);
    $words = explode(' ', $words);
    sort($words); 
    file_put_contents($file, implode(' ', $words)); 
    echo "Слова відсортовано та збережено у файл.";
} else {
    echo "Файл $file не знайдено.";
}
?>