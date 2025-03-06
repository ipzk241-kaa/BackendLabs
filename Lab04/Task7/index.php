<?php

require_once 'FileManager.php';

echo "Вміст файлу file1.txt: <br>";
echo FileManager::readFile('file1.txt') . "<br><br>";

echo "Запис у файл file1.txt: <br>";
if (FileManager::writeFile('file1.txt', 'Це новий рядок, який додається до файлу')) {
    echo "Рядок успішно дописано до file1.txt.<br>";
} else {
    echo "Не вдалося дописати в файл file1.txt.<br>";
}

echo "<br>Вміст файлу file1.txt після допису: <br>";
echo FileManager::readFile('file1.txt') . "<br><br>";

echo "Очищення вмісту файлу file1.txt: <br>";
if (FileManager::clearFile('file1.txt')) {
    echo "Вміст файлу file1.txt очищено.<br>";
} else {
    echo "Не вдалося очистити файл file1.txt.<br>";
}

echo "<br>Вміст файлу file1.txt після очищення: <br>";
echo FileManager::readFile('file1.txt') . "<br>";
