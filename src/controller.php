<?php

$thisPath = $_SERVER['SCRIPT_NAME'];
$thisPathArr = explode('/', $thisPath);
$thisFileName = array_pop($thisPathArr);
$thisPathArr = explode('.', $thisFileName);
$thisPageName = $thisPathArr[0];
$thisPage = $pages[$thisPageName];

if($thisPageName === 'logout') {
    $_SESSION = [];
    header("Location: index.php");
}

// поменять статус у задачи на "завершена"
if(isset($_GET['taskComplete'])){
    taskCompleter($_GET['taskComplete'], $bdConnectData);
    header("Location: index.php");
}

// проверка на пустую строку поиска на главной
if(isset($_GET['search']) && (strlen(trim($_GET['search'])) == 0)){
    header("Location: index.php");
}

$isAuthorized = isset($_SESSION['currentUser']) ? TRUE : FALSE;
$toReg = ($thisPageName === 'authorization' || $thisPageName === 'registration') ? TRUE : FALSE;

if ($isAuthorized || $toReg){
// подключаем нужный обработчик формы, если POST
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        include_once(ROOT_PATH . '/src/handlers/' . $thisFileName);
    } else {
        // иначе, если нет пост-запроса, подключаем обычный шаблон
        $pageContent = include_template($thisPage['tpl'], $thisPage['vars']);
    }

} else {
    $pageContent = include_template('guest.php', []);
    // $pageContent = include_template($thisPage['tpl'], $thisPage['vars']);
}

$resultPage = include_template('layout.php', [
    'pageContent' => $pageContent, 
    'currentUser' => $currentUser, 
    'pageName' => $thisPageName
]);

print($resultPage);
?>