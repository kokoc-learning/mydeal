<?php
    include_once('data.php');
    include_once('helpers.php');

    if (!isset($_SESSION['user'])){
        include_once('guest.php');
    }
    else{
        print(include_template('layout.php', $tasks));
    }
?>

