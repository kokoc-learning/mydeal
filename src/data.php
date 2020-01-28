<?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

$pageName = 'Дела в порядке';

$userEmail = 'vasya@mail.com';


$con = mysqli_connect('localhost', 'root', '','mydealsDB');
// д
// $con = mysqli_connect('localhost', 'u0857553_root', 'U0l7D5q1','u0857553_mydealsdb');

if(!$con) {
    echo 'Ошибка подключения к MySQL '. mysqli_connect_error();
}

mysqli_set_charset($con, 'utf8');


// запрос данных пользователя
$sqlRes = mysqli_query($con, "SELECT `id`, `name`, `email` FROM `user` WHERE email = '".$userEmail."' ");
$userData = mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);
$userName = $userData[0]['name'];
$userId = $userData[0]['id'];
$currentUser['id'] = $userData[0]['id'];
$currentUser['name'] = $userData[0]['name'];

// запрос списка проектов
$sqlRes = mysqli_query($con, 'SELECT `id`, `name` FROM `project` WHERE `user_id` = '.$userId.' ORDER BY `name` ');
$projectList = mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);

// запрос списка задач
$sqlRes = mysqli_query($con, 
"SELECT project.id AS categiryId, task.name, task.deadline, project.name AS category, task.status AS isComplete 
    FROM `task` 
    JOIN `project` ON task.project_id = project.id 
    WHERE task.user_id = '".$userId."' 
    ORDER BY task.name");

$taskList = mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);

mysqli_close($con);

$pages = array(
  'index' => array(
    'url_key' => '/index.php',
    'tpl' => 'main.php',
    'title' => 'Главная страница',
    'vars' => array(
      'show_complete_tasks' => $show_complete_tasks, 
      'projectList' => $projectList, 
      'taskList' => $taskList,
      'currentUser' => $currentUser
    )
  ),
  'add' => array(
    'url_key' => '/add.php',
    'tpl' => 'add.php',
    'title' => 'Добавить задачу',
    'vars' => array(
      'show_complete_tasks' => $show_complete_tasks, 
      'projectList' => $projectList, 
      'taskList' => $taskList,
      'currentUser' => $currentUser
    )
  )
); 
  

// $projectList = array('Входящие','Учеба','Работа','Домашние дела','Авто');

// $taskList = array(
//     array (
//         'name' => 'Собеседование в IT компании',
//         'deadline' =>'03.02.2020',
//         'category' => 'Работа',
//         'isComplete' => false
//     ),
//     array (
//         'name' => 'Выполнить тестовое задание',
//         'deadline' =>'01.02.2020',
//         'category' => 'Работа',
//         'isComplete' => false
//     ),
//     array (
//         'name' => 'Сделать задание первого раздела',
//         'deadline' =>'17.01.2020',
//         'category' => 'Учеба',
//         'isComplete' => true
//     ),
//     array (
//         'name' => 'Встреча с другом',
//         'deadline' =>'17.01.2020',
//         'category' => 'Входящие',
//         'isComplete' => false
//     ),
//     array (
//         'name' => 'Купить корм для кота',
//         'deadline' => '15.01.2020',
//         'category' => 'Домашние дела',
//         'isComplete' => false
//     ),
//     array (
//         'name' => 'Заказать пиццу',
//         'deadline' => null,
//         'category' => 'Домашние дела',
//         'isComplete' => false
//     )

// );


?>

