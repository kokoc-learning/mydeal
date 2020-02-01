<?php
$isAuthorized = isset($_SESSION['currentUser']) ? TRUE : FALSE;
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);




// запрос данных пользователя (старый)
// $sqlRes = mysqli_query($con, "SELECT `id`, `name`, `email` FROM `user` WHERE email = '".$userEmail."' ");
// $userData = mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);
// $userName = $userData[0]['name'];
// $userId = $userData[0]['id'];
// $currentUser['id'] = $userData[0]['id'];
// $currentUser['name'] = $userData[0]['name'];

// если не авторизован пользователь, то...
$currentUser = array(
  'id' => '',
  'name' => 'Гость',
  'email' => '',
  'password' => '',
  'reg_date' => ''
);

$projectList = [];
$taskList = [];


if ($isAuthorized) {
  $currentUser = $_SESSION['currentUser'];

  $con = mysqli_connect('localhost', 'root', '','mydealsDB');

  // Для сайта инфа ниже
  // $con = mysqli_connect('localhost', 'u0857553_root', 'U0l7D5q1','u0857553_mydealsdb'); 

  if(!$con) {
      echo 'Ошибка подключения к MySQL '. mysqli_connect_error();
  }

  mysqli_set_charset($con, 'utf8');
  // запрос списка проектов
  $sqlRes = mysqli_query($con, 'SELECT `id`, `name` FROM `project` WHERE `user_id` = '.$currentUser['id'].' ORDER BY `name` ');
  $projectList = mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);
  
  // запрос списка задач
  $sqlRes = mysqli_query($con, 
  "SELECT project.id AS categoryId, task.name, task.deadline, project.name AS category, task.status AS isComplete, task.file AS `file`
      FROM `task` 
      JOIN `project` ON task.project_id = project.id 
      WHERE task.user_id = '".$currentUser['id']."' 
      ORDER BY task.name");
  
  $taskList = mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);
  
  mysqli_close($con);
}


$pages = array(
  'index' => array(
    'url_key' => '/index.php',
    'tpl' => 'main.php',
    'vars' => array(
      'pageTitle' => 'Главная страница',
      'show_complete_tasks' => $show_complete_tasks, 
      'projectList' => $projectList, 
      'taskList' => $taskList,
      'currentUser' => $currentUser
    )
  ),
  'add' => array(
    'url_key' => '/add.php',
    'tpl' => 'add.php',
    'vars' => array(
      'pageTitle' => 'Добавить задачу',
      'show_complete_tasks' => $show_complete_tasks, 
      'projectList' => $projectList, 
      'taskList' => $taskList,
      'currentUser' => $currentUser
    )
  ),
  'registration' => array(
    'url_key' => '/registration.php',
    'tpl' => 'registration.php',
    'vars' => array(
      'pageTitle' => 'Регистрация',
      
    )
  ),
  'authorization' => array(
    'url_key' => '/authorization.php',
    'tpl' => 'authorization.php',
    'vars' => array(
      'pageTitle' => 'Авторизация',
      
    )
  ),
  'guest' => array(
    'url_key' => '/guest.php',
    'tpl' => 'guest.php',
    'vars' => array(
      'pageTitle' => 'Гость',
      
    )
  ),
  'logout' => array(
    'url_key' => '/logout.php',
    'tpl' => 'logout.php',
    'vars' => array(
      'pageTitle' => 'Logout',
      
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