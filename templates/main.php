<div class="content">
            <section class="content__side">
                <h2 class="content__side-heading">Проекты</h2>

                <nav class="main-navigation">
                    <ul class="main-navigation__list">
                    <?php
                        foreach ($projectList as $project) {
                            echo '
                            <li class="main-navigation__list-item">
                                <a class="main-navigation__list-item-link" href="#">'.$project['name'].'</a>
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
                        foreach ($taskList as $task) {
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

                                    <td class="task__file">
                                      <a class="download-link" href="#"></a>
                                    </td>

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
                    ?>
                    
                    <!-- <tr class="tasks__item task">
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
                        
                    </tr> -->
                    <!--показывать следующий тег <tr/>, если переменная $show_complete_tasks равна единице-->

                    <?php
                    if ($show_complete_tasks === 1) {
                        echo '
                        <tr class="tasks__item task task--completed">
                            <td class="task__select">
                                <label class="checkbox task__checkbox">
                                    <input class="checkbox__input visually-hidden" type="checkbox" checked>
                                    <span class="checkbox__text">Записаться на интенсив "Базовый PHP"</span>
                                </label>
                            </td>
                            <td class="task__date">10.10.2019</td>
                            <td class="task__controls"></td>
                        </tr>
                        ';
                    }
                    ?>
                   
                </table>
            </main>
</div>