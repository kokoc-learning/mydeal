<div class="content">
    <section class="content__side">
        <h2 class="content__side-heading">Проекты</h2>

        <nav class="main-navigation">
            <ul class="main-navigation__list">
            <?php
                foreach ($projectList as $project) {
                    
                    echo '
                    <li class="main-navigation__list-item';

                    // делаем активным пункт списка проектов
                    if (isset($_GET['projectid']) && $_GET['projectid'] === $project['id']){
                        echo ' main-navigation__list-item--active';
                    }

                    echo '">
                        <a class="main-navigation__list-item-link" href="index.php?projectid='.$project['id'].'">'.$project['name'].'</a>
                        <span class="main-navigation__list-item-count">'.projectsInTaskListCount($taskList, $project['name']).'</span>
                    </li>
                    ';
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
                <?php
                    if ($show_complete_tasks === 1) {
                        echo "checked";
                    }
                ?>
                >
                <span class="checkbox__text">Показывать выполненные</span>
            </label>
        </div>

        <table class="tasks">

            <?php
                // если нужный ключ есть в массиве, то...
                if(isset($_GET['projectid'])){
                    // id активного проекта
                    $activeProjectId = $_GET['projectid'];
                    // выбран ли проект с определенным id (пустое или нет поле с id проекта)
                    $projectIdIsset = TRUE;
                } else {
                    $projectIdIsset = FALSE;
                }

                // проверка корректности id проекта, указанного в параметре запроса
                if ( $projectIdIsset && !projectIdCheck($activeProjectId, $projectList)){
                    echo '404. Page not found';
                } else {
                    foreach ($taskList as $task) {
                        // далее идет код для фильтра дел по категориям
                        if ( $projectIdIsset && $activeProjectId !== $task['categoryId']){
                            continue;
                        }

                        $deadLineIsComing = deadLineLeftHours($task['deadline']);
                        if ($show_complete_tasks === 0 && intval($task['isComplete']) === 1) {
                            continue;
                        }

                        echo '
                            <tr class="tasks__item task';
                            if ($task['isComplete']) {
                                echo ' task--completed';
                            }

                            if ($deadLineIsComing <= 24 && $deadLineIsComing > 0) {
                                echo ' task--important';
                            }

                            echo '">
                                <td class="task__select">
                                    <label class="checkbox task__checkbox">
                                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1">
                                        <span class="checkbox__text">'.$task['name'].'</span>
                                    </label>
                                </td>

                                <td class="task__file">';

                                if(isset($task['file'])){
                                    echo '<a class="download-link" href="';
                                    echo $task['file'];
                                    echo '" download></a>';
                                    
                                }
                                
                                echo '</td>

                                <td class="task__date">';
                                // не удержался и прикрутил сообщение, если просрал дедлайн
                                if ($deadLineIsComing < 0) {
                                    echo 'Wasted!';
                                } else {
                                    echo $task['deadline'];
                                }
                                echo '</td>
                            </tr>
                        ';
                    }
                }

                
            ?>
            
        
        </table>
            </main>
</div>