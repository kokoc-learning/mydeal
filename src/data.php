<?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

$pageName = 'Дела в порядке';
$userName = 'Юзверь';

$projectList = array('Входящие','Учеба','Работа','Домашние дела','Авто');

$taskList = array(
    array (
        'taskName' => 'Собеседование в IT компании',
        'deadline' =>'01.12.2019',
        'category' => 'Работа',
        'isComplete' => false
    ),
    array (
        'taskName' => 'Выполнить тестовое задание',
        'deadline' =>'25.12.2019',
        'category' => 'Работа',
        'isComplete' => false
    ),
    array (
        'taskName' => 'Сделать задание первого раздела',
        'deadline' =>'21.12.2019',
        'category' => 'Учеба',
        'isComplete' => true
    ),
    array (
        'taskName' => 'Встреча с другом',
        'deadline' =>'22.12.2019',
        'category' => 'Входящие',
        'isComplete' => false
    ),
    array (
        'taskName' => 'Купить корм для кота',
        'deadline' => null,
        'category' => 'Домашние дела',
        'isComplete' => false
    ),
    array (
        'taskName' => 'Заказать пиццу',
        'deadline' => null,
        'category' => 'Домашние дела',
        'isComplete' => false
    )

);


?>

