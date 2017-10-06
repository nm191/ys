<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/ys/classes/config.php');
    Protect::mustBeLoggedIn();
    unset($_SESSION['user']);
    session_destroy();
    header('Location: http://'.PUBLIC_ROOT.'index.php');
?>