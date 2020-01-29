<?php

$thisPath = $_SERVER['SCRIPT_NAME'];
$thisPathArr = explode('/', $thisPath);
$thisFileName = array_pop($thisPathArr);
$thisPathArr = explode('.', $thisFileName);
$thisPageName = $thisPathArr[0];
$thisPage = $pages[$thisPageName];


// подключаем нужный обработчик формы, если POST
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once(ROOT_PATH . '/src/handlers/' . $thisFileName);
} else {
    // иначе, если нет пост-запроса, подключаем обычный шаблон
    $pageContent = include_template($thisPage['tpl'], $thisPage['vars']);
}


$resultPage = include_template('layout.php', [
    'pageContent' => $pageContent, 
    'userName' => $userName, 
    'pageName' => $pageName
]);

print($resultPage);
?>