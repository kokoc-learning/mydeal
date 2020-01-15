<?php

// echo '<br> include config.php';


define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
define('PATH_SRC', ROOT_PATH . '/src/');
define('PATH_TPL', ROOT_PATH . '/templates/');

include_once(PATH_SRC .'data.php');
include_once(PATH_SRC .'functions.php');

$mainContent = include_template('main.php', [
    'show_complete_tasks' => $show_complete_tasks, 
    'projectList' => $projectList, 
    'taskList' => $taskList
]);

$resultPage = include_template('layout.php', [
    'mainContent' => $mainContent, 
    'userName' => $userName, 
    'pageName' => $pageName
]);


print($resultPage);
?>