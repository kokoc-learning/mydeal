<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <ul class="main-navigation__list">
            <?php
                foreach ($arr_projects as $key => $value) {
                    //проверяем гет параметр
                    if($project_show==$key){
                        $active_project = 'main-navigation__list-item--active';
                    }

                    echo '
                    <li class="main-navigation__list-item '.$active_project.'">
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
        <?php
        foreach ($arr_tasks as $key => $value) {
            //расчет времени до цели
            if($value['date_complete']){
                
                $now_date = time();
                $target_date = strtotime($value['date_complete']);
                $date_range = $target_date - $now_date;
                $tmp_date = strtotime($value['date_complete']);
                $format_date = date('d.m.Y', $tmp_date);

                if($date_range > 0){
                    $res_hour = floor($date_range / 60 / 60);
                    if($res_hour <= 24){
                        $task_important = 'task--important';
                    } else {
                        $task_important = '';
                    } 
                } else {
                    $task_important = '';   
                }        
            }
            
            //присвоение классов
            if($value['status']){
                $mark_complete = 'task--completed';
                $checked = 'checked';
            }

            //шаблон вывода задачи
            if($value['status'] && $show_complete_tasks == 0){
                $mark_complete = '';
                $checked = 'value="1"';
                continue;
            } else {
                echo '
                <tr class="tasks__item task '.$mark_complete.' '.$task_important.'">
                    <td class="task__select">
                        <label class="checkbox task__checkbox">
                            <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" '.$checked.' >
                            <span class="checkbox__text">'.$value['title'].'</span>
                        </label>
                    </td>

                    <td class="task__file">
                        <a class="download-link" href="#">Home.psd</a>
                    </td>

                    <td class="task__date">'.$format_date.'</td>
                </tr>
                ';
                $mark_complete = '';
                $checked = 'value="1"';
                $task_important = '';
            }   
        }
        ?>
    </table>
</main>