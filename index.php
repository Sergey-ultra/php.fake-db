<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Тест</title>
    <link rel="stylesheet" href="/assets/css/normalize.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<aside class="aside">
    <div class="aside__column">
        <div class="aside__item">
            <img src="/assets/img/b_newdb.png" title="Добавить базу данных" alt="Добавить базу данных"
                 class="icon ic_s_db">
            <a href="/create.php">
                Создать бд
            </a>
        </div>
        <?php
        require_once 'logic/databases.php';
        $databases = Databases::read('logic/db_list.csv', 'csv');
        if ($databases) {
            foreach ($databases as $database): ?>
                <div class="aside__item">
                    <img src="/assets/img/s_db.png" title="Операции с базой данных" alt="Операции с базой данных"
                         class="icon ic_s_db">
                    <a href="<?php echo  '/databases/' . $database[0] . '.php'; ?>">
                        <?php echo $database[0]; ?>
                    </a>
                </div>
            <?php endforeach;
        } ?>
    </div>
</aside>
<main class="main">
    <h3><a href="/">Главная</a></h3>
    <?php
    $fn = $_SERVER['REQUEST_URI'];

    switch ($fn){
        case '/':
             require_once 'parts/main.php';
             break;
        case '/create.php':
             require_once 'parts/create_db.php';
             break;
    }

    if (strpos($fn, 'databases') !== false) {
        require_once 'parts/tables.php';
    }
    if (strpos($fn, 'tables') !== false) {
        require_once 'parts/table.php';
    }
    ?>
</main>
</body>
</html>
