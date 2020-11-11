<?php
    include_once('data.php');
    unset($_SESSION['user']);
    header('Location:  index.php');
?>