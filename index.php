<?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

$title = 'Дела в порядке';

$arrScripts = [

    'Собеседование в IT компании' => [
        '01.12.2019' => ['работа', false]
    ],

    'Выполнить тестовое задание' => [
        '25.12.2019' => ['работа', false]
    ],

    'Сделать задание первого раздела' => [
        '21.12.2019' => ['учеба', true]
    ],

    'Встреча с другом' => [
        '22.12.2019' => ['Входящие', false]
    ],

    'Купить корм для кота' => [
        null => ['Домашние дела', false]
    ],

    'Заказать пиццу' => [
        null => ['Домашние дела', false]
    ]

    ];

    function projectCount($arr, $projectName) {

        $countNum = 0;
        if(array_key_exists($projectName, $arr)) {
            $countNum = count($arr[$projectName]);
        } else {
            return $countNum;
        }

        return $countNum;
    }

?>


 <?php
    include_once('templates/layout.php');
 ?>

