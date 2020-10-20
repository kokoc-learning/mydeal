<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?=$data['title']?></title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/flatpickr.min.css">
</head>

<body>
<h1 class="visually-hidden">Дела в порядке</h1>

<div class="page-wrapper">
    <div class="container container--with-sidebar">
        <header class="main-header">
            <a href="/">
                <img src="img/logo.png" width="153" height="42" alt="Логотип Дела в порядке">
            </a>

            <div class="main-header__side">
                <a class="main-header__side-item button button--plus open-modal" href="pages/form-task.html">Добавить задачу</a>

                <div class="main-header__side-item user-menu">
                    <div class="user-menu__data">
                        <p><?=$data['title']?></p>

                        <a href="#">Выйти</a>
                    </div>
                </div>
            </div>
        </header>
        <div class="content">
        <?=$data['content'];?> 
        </div>
        <!--
            тут был контент
        -->
    </div>
</div>

<script src="flatpickr.js"></script>
<script src="script.js"></script>
</body>
</html>