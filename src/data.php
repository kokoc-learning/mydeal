<?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

$pageName = 'Дела в порядке';
$userName = 'Юзверь';

$projectList = array('Входящие','Учеба','Работа','Домашние дела','Авто');

$taskList = array(
    array (
        'taskName' => 'Собеседование в IT компании',
        'deadline' =>'03.02.2020',
        'category' => 'Работа',
        'isComplete' => false
    ),
    array (
        'taskName' => 'Выполнить тестовое задание',
        'deadline' =>'01.02.2020',
        'category' => 'Работа',
        'isComplete' => false
    ),
    array (
        'taskName' => 'Сделать задание первого раздела',
        'deadline' =>'17.01.2020',
        'category' => 'Учеба',
        'isComplete' => true
    ),
    array (
        'taskName' => 'Встреча с другом',
        'deadline' =>'17.01.2020',
        'category' => 'Входящие',
        'isComplete' => false
    ),
    array (
        'taskName' => 'Купить корм для кота',
        'deadline' => '15.01.2020',
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

