<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вибір розміру шрифту</title>
</head>
<body>
    <h1>Виберіть розмір шрифту:</h1>
    <ul>
        <li><a href="?font_size=large">Великий шрифт</a></li>
        <li><a href="?font_size=medium">Середній шрифт</a></li>
        <li><a href="?font_size=small">Маленький шрифт</a></li>
    </ul>

    <?php
    if (isset($_GET['font_size'])) {
        $font_size = $_GET['font_size'];
        setcookie('font_size', $font_size, time() + (86400 * 5), "/");
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

    $current_font_size = 'medium';
    if (isset($_COOKIE['font_size'])) {
        $current_font_size = $_COOKIE['font_size'];
    }

    $font_size_map = [
        'large' => '24px',
        'medium' => '16px',
        'small' => '12px'
    ];
    $current_font_size_css = $font_size_map[$current_font_size];
    ?>

    <p style="font-size: <?php echo $current_font_size_css; ?>;">
        Це приклад тексту з вибраним розміром шрифту.
    </p>
</body>
</html>