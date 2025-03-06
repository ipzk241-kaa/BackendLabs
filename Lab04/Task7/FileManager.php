<?php

class FileManager {
    private static $dir = 'text';

    public static function readFile($filename) {
        $filePath = self::$dir . DIRECTORY_SEPARATOR . $filename;
        
        if (file_exists($filePath)) {
            return file_get_contents($filePath);
        } else {
            return "Файл не знайдено!";
        }
    }

    public static function writeFile($filename, $content) {
        $filePath = self::$dir . DIRECTORY_SEPARATOR . $filename;

        $file = fopen($filePath, 'a');
        if ($file) {
            fwrite($file, $content . PHP_EOL);
            fclose($file);
            return true;
        } else {
            return false;
        }
    }

    public static function clearFile($filename) {
        $filePath = self::$dir . DIRECTORY_SEPARATOR . $filename;

        if (file_exists($filePath)) {
            file_put_contents($filePath, ''); 
            return true;
        } else {
            return false;
        }
    }
}
