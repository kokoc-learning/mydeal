<?php

$thisPath = $_SERVER['SCRIPT_NAME'];
$thisPathArr = explode('/', $thisPath);
$thisPageName = array_pop($thisPathArr);
$thisPathArr = explode('.', $thisPageName);
$thisPageName = $thisPathArr[0];
$thisPage = $pages[$thisPageName];

$pageContent = include_template('/'.$thisPage['tpl'], $thisPage['vars']);

$resultPage = include_template('layout.php', [
    'pageContent' => $pageContent, 
    'userName' => $userName, 
    'pageName' => $pageName
]);


print($resultPage);
?>