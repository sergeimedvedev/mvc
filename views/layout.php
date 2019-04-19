<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sergey Medvedev">
    <meta name="description" content="Тестовое задание в компанию BeeJee на должность веб-разработчика">
    <title>Simple MVC Task Book</title>
    <link rel="stylesheet" href="/src/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">

    <a class="navbar-brand" href="/">Задачник</a>

    <ul class="navbar-nav">
        <li class="nav-item">
            <?php if (!$_SESSION['admin']) : ?>
                <a class="nav-link" href="/user/login">Вход</a>
            <?php else : ?>
                <a class="nav-link" href="/user/logout">Выход (Администратор)</a>
            <?php endif; ?>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/task/create">Добавить задачу</a>
        </li>
    </ul>

</nav>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <?= $content ?? '' ?>
    </div>
</div>

<script src="./src/js/bootstrap.min.js"></script>

</body>
</html>