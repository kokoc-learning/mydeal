<?php
function task_count($task_list, $project) {
    $count = 0;
    foreach($task_list as $value) {
        if ($value['project_name'] == $project)
            $count++;
    }
    return $count;
}

function check_time($date) {
    $today = strtotime("now");
    $dead_line = strtotime($date);
    $time_to_deadline = ($dead_line -  $today) / 3600;
    if ($time_to_deadline < 24){
        return true;
    }
    return false;
}

$show_complete_tasks = rand(0, 1);
    include('data.php');
?>

<section class="content__side">
                <h2 class="content__side-heading">Проекты</h2>

                <nav class="main-navigation">
                    <ul class="main-navigation__list">
                    <?php
                        $temp = [];
                        foreach ($projects as $value) {
                            if (!in_array($value['project_name'], $temp))
                                array_push($temp, $value['project_name']);
                        }
                        for ($i = 0; $i < count($temp); $i++) {
                            echo'
                            <li class="main-navigation__list-item">
                                <a class="main-navigation__list-item-link" href="#">'. $temp[$i] .'</a>
                                <span class="main-navigation__list-item-count">'. task_count($tasks, $temp[$i]) .'</span>
                            </li>';
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
                        <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
                        <input class="checkbox__input visually-hidden show_completed" type="checkbox" 
                            <? if ($show_complete_tasks == 1) echo "checked"; ?>>
                        <span class="checkbox__text">Показывать выполненные</span>
                    </label>
                </div>

                <table class="tasks">
                    <tr class="tasks__item task">
                        <td class="task__select">
                            <label class="checkbox task__checkbox">
                                <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1">
                                <span class="checkbox__text">Сделать главную страницу Дела в порядке</span>
                            </label>
                        </td>

                        <td class="task__file">
                            <a class="download-link" href="#">Home.psd</a>
                        </td>

                        <td class="task__date"></td>
                    </tr>
                    <?php
                        $complete_class = ' ';
                        $checked = ' ';
                        $flag = true;
                        foreach ($tasks as $value) {
                            if ($value['complete']){
                                $complete_class = ' task task--completed';
                                $checked = ' checked';
                                if ($show_complete_tasks == 0) {
                                    $flag = false;
                                }
                            }
                            if (check_time($value['deadline']) && !empty($value['deadline'])) {
                                $complete_class = ' task task--important';
                            }

                            if ($flag){
                                echo'<tr class="tasks__item'. $complete_class .'">
                                <td class="task__select">
                                    <label class="checkbox task__checkbox">
                                        <input class="checkbox__input visually-hidden" type="checkbox"' . $checked . '>
                                        <span class="checkbox__text">'. $value['task_name'] .'</span>
                                    </label>
                                </td>
                                <td class="task__date">'. $value['deadline'] .'</td>
                                <td class="task__controls"></td>
                                </tr>';
                        }
                    }
                        ?>
                </table>
            </main>
        