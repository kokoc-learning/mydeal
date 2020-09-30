<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <ul class="main-navigation__list">
            <?php
                foreach ($arr_projects as $key => $value) {
                    echo '
                    <li class="main-navigation__list-item">
                        <a class="main-navigation__list-item-link" href="?show='.$key.'">'.$value.'</a>
                        <span class="main-navigation__list-item-count">'.countProjects($tasks, $value).'</span>
                    </li>
                    ';
                    $active_project = '';    
                }
            ?>
        </ul>
    </nav>

    <a class="button button--transparent button--plus content__side-button"
        href="pages/form-project.html" target="project_add">Добавить проект</a>
</section>

<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>

    <form class="search-form" action="index.php" method="post" autocomplete="off">
        <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>

    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
            <a href="/" class="tasks-switch__item">Повестка дня</a>
            <a href="/" class="tasks-switch__item">Завтра</a>
            <a href="/" class="tasks-switch__item">Просроченные</a>
        </nav>

        <label class="checkbox">
            <input class="checkbox__input visually-hidden show_completed" <?= ($show_complete_tasks == 1) ? "checked" : "" ?> type="checkbox">
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>

    <table class="tasks">
        <h2>Извините, такой страницы не существует</h2>
    </table>
</main>