<?php
    $connect = mysqli_connect("localhost", "root", "root", "mydeal");

    if (!$connect) {
        print("Ошибка" . mysqli_connect_error());
    }

    $project_query = "SELECT U.user_name, P.project_name FROM projects P JOIN users U ON P.autor = 'Cat'";
    $project_result = mysqli_query($connect, $project_query);
    $projects = mysqli_fetch_all($project_result, MYSQLI_ASSOC);

    $task_query = "SELECT T.task_name, T.project_name, T.deadline from tasks T WHERE T.autor = 'Cat'";
    $task_result = mysqli_query($connect, $task_query);
    $tasks = mysqli_fetch_all($task_result, MYSQLI_ASSOC);



// $tasks = array(
//     array(
//         'name' => 'Собеседование в  IT компании',
//         'deadline' => '24.10.2020',
//         'type' => 'Работа',
//         'complete' => false,
//     ),
//     array(
//         'name' => 'Выполнить тестовое задание',
//         'deadline' => '05.11.2020',
//         'type' => 'Работа',
//         'complete' => false,
//     ),
//     array(
//         'name' => 'Сделать задание первого раздела',
//         'deadline' => '21.12.2020',
//         'type' => 'Учеба',
//         'complete' => true,
//     ),
//     array(
//         'name' => 'Встреча с другом',
//         'deadline' => '22.12.2020',
//         'type' => 'Входящие',
//         'complete' => false,
//     ),
//     array(
//         'name' => 'Купить корм для кота',
//         'deadline' => '',
//         'type' => 'Домашние дела',
//         'complete' => false,
//     ),
//     array(
//         'name' => 'Заказать пиццу',
//         'deadline' => '',
//         'type' => 'Домашние дела',
//         'complete' => false,
//     ),
//     );
    ?>