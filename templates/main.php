<?php
date_default_timezone_set('Europe/Moscow');
$days = $_GET['list'];
$active_class = ' tasks-switch__item--active';

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

function dates_status($date) {
    $today = strtotime("now");
    $dead_line = strtotime($date);
    $time_to_deadline = ($dead_line -  $today) / 3600;
    if ($time_to_deadline > 0 && $time_to_deadline < 24){
        return 2;
    }
    if ($time_to_deadline > -24 && $time_to_deadline < 0) {
        return 1;
    }
    if ($today > $dead_line && isset($date)) {
        return 3;
    }
    return 4;
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
                        $temp_id = [];
                        $target_class = '';

                        foreach ($projects as $value) {
                            if (!in_array($value['project_name'], $temp))
                                array_push($temp, $value['project_name']);
                                
                            if (!in_array($value['id'], $temp))
                                array_push($temp_id, $value['id']);

                        }
                        $temp_id = array_unique($temp_id);
                        $id = [];
                        foreach ($temp_id as $param) {
                            $id[] = $param;
                        }

                        if (!in_array($_GET['id'], $id) && $_GET['id'] != '') {
                            header('Location: /error404/');
                        }

                        for ($i = 0; $i < count($temp); $i++) {
                            if(isset($_GET['id']) && $_GET['id'] != '' && $id[$i] == $_GET['id']) {
                                $target_class = ' main-navigation__list-item--active';
                            }   
                            else{
                                $target_class = '';
                            }
                           
                            $url = "index.php?id=" . $id[$i];
                            echo'
                            <li class="main-navigation__list-item ' . $target_class . '">
                                <a class="main-navigation__list-item-link" href="'. $url .'">'. $temp[$i] .'</a>
                                <span class="main-navigation__list-item-count">'. task_count($tasks, $temp[$i]) .'</span>
                            </li>';

                            // if (task_count($tasks, $temp[$i]) == 0 && $_GET['id'] != '') {
                            //     header('Location: /error404/');
                            // }
                        }
                    ?>
                    </ul>
                </nav>

                <a class="button button--transparent button--plus content__side-button"
                   href="add_project.php" target="project_add">Добавить проект</a>
            </section>

            <main class="content__main">
                <h2 class="content__main-heading">Список задач</h2>

                <form class="search-form" action="index.php" method="get" autocomplete="off">
                    <input class="search-form__input" type="text" name="search" value="" placeholder="Поиск по задачам">
                    <input class="search-form__submit" type="submit" name="search_button" value="Искать">
                </form>

                <div class="tasks-controls">
                    <nav class="tasks-switch">
                        <a href="index.php" class="tasks-switch__item <?php if (!isset($days)) echo $active_class; ?>">Все задачи</a>
                        <a href="index.php?list=1" class="tasks-switch__item <?php if ($days == 1) echo $active_class; ?>">Повестка дня</a>
                        <a href="index.php?list=2" class="tasks-switch__item <?php if ($days == 2) echo $active_class; ?>">Завтра</a>
                        <a href="index.php?list=3" class="tasks-switch__item <?php if ($days == 3) echo $active_class; ?>">Просроченные</a>
                    </nav>

                    <label class="checkbox">
                        <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
                        <input class="checkbox__input visually-hidden show_completed" type="checkbox" 
                            <? if ($show_complete_tasks == 1) echo "checked"; ?>>
                        <span class="checkbox__text">Показывать выполненные</span>
                    </label>
                </div>

                <table class="tasks">
                    <?php
                        $id = $_GET['id'];
                        $temp_tasks = [];
                        if(isset($id) && $id != '') {
                            $query = "SELECT P.project_name FROM projects P JOIN users U ON P.autor = '$user' WHERE P.id = '$id'";
                            $result = mysqli_query($connect, $query);
                            $find = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            $name = $find[0]['project_name'];
                            
                            $query1 = "SELECT T.task_name, T.project_name, T.deadline, T.status from tasks T 
                            WHERE T.autor = '$user' AND T.project_name = '$name'";
                            $result1 = mysqli_query($connect, $query1);
                            $end = mysqli_fetch_all($result1, MYSQLI_ASSOC);
                            foreach ($end as $res) {
                                $temp_tasks[] = $res;
                            }
                        }
                        else {
                            $temp_tasks = $tasks;
                        }
                        $search_form = $_GET['search'];
                        if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['search_button'] && isset($search_form)) {
                            $find = "CREATE FULLTEXT INDEX tasks_search ON tasks(task_name)"; 
                            mysqli_query($connect, $find);

                            $sql = "SELECT project_name, task_name, deadline FROM tasks WHERE autor = '$user' AND MATCH(task_name) AGAINST('$search_form')";
                            $search_query = mysqli_query($connect, $sql);
                            $temp_tasks = mysqli_fetch_all($search_query, MYSQLI_ASSOC);
                            if (empty($temp_tasks)) {
                                echo "По вашему запросу ничего не найдено!";
                            }
                            
                        }

                        foreach ($temp_tasks as $value) {
                            $day_status = false;
                            if (isset($days) && $days == dates_status($value['deadline'])){
                                if ($value['status'] != 1) {
                                    $_SESSION['mail_user'] = $user;
                                    $_SESSION['mail_tasks'] = $value['task_name'];
                                    include_once('notify.php');
                                }
                                $day_status = true;
                            }
                            $complete_class = ' ';
                            $checked = ' ';
                            $flag = true;

                            if ($value['status'] == 1){
                                if ($show_complete_tasks == 0) {
                                    $flag = false;
                                }
                                $complete_class = ' task task--completed';
                                $checked = ' checked';
                            }
                            if (check_time($value['deadline']) && !empty($value['deadline']) && $value['status'] != 1) {
                                $complete_class = ' task task--important';
                            }

                            if ($flag && $day_status || $flag && !isset($days)){
                                echo'<tr class="tasks__item'. $complete_class .'">
                                <td class="task__select">
                                    <label class="checkbox task__checkbox">
                                        <form method="post" action="index.php">
                                            <input class="checkbox__input visually-hidden" type="checkbox" name="complete" ' . $checked . '>
                                            <span class="checkbox__text">'. $value['task_name'] .'</span>
                                        </form>
                                    </label>
                                </td>';
                                if (!empty($value['link'])){
                                    echo '<td class="task__file">
                                    <a class="download-link" href="' . $value['link'] . '">Файл</a>
                                    </td>';
                                }

                                echo '<td class="task__date">'. $value['deadline'] .'</td>
                                <td class="task__controls"></td>
                                </tr>';
                            }
                    }
                        ?>
                </table>
            </main>
        