<?php

function include_template($name, array $data = []) {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

$username = 'Константин';

// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

$projects = array(
    'Работа','Учеба','Входящие','Домашние дела','Авто'
);

$tasks = array(
    array('Собеседование в IT компании', '01.12.2019', 'Работа', false),
    array('Выполнить тестовое задание', '19.10.2020', 'Работа', false),
    array('Сделать задание первого раздела', '21.12.2019', 'Учеба', true),
    array('Встреча с другом', '22.12.2019', 'Входящие', false),
    array('Купить корм для кота', 'null', 'Домашние дела', false),
    array('Заказать пиццу', 'null', 'Домашние дела', false)
);

function howmuch($innertasks,$projectname){
    $j = 0;
    for ($i = 0; $i < count($innertasks); $i++){
        if($innertasks[$i][2] == $projectname)
            $j++;
    }
    return $j;
}

$page_content = include_template('main.php', ['projects' => $projects, 'tasks' => $tasks, 'toshowornottoshow' => $show_complete_tasks]);

$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $username]);

print($layout_content);

?>