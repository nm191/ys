<?php
    Protect::mustBeLoggedIn();
    //get current page name
    $url_ar = explode('/', $_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yellow-stone: Klimlessen</title>
    <!-- Include Bootstrap, jQuery & Tether-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Include FontAwesome-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-LRlmVvLKVApDVGuspQFnRQJjkv0P7/YFrw84YYQtmYG4nK8c+M+NlmYDCv0rKWpG" crossorigin="anonymous">
    <!-- Include jQuery UI-->
    <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Include datatables-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/datatables.min.css"/>
 
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/datatables.min.js"></script>


    <!-- Main styles-->
    <link rel="stylesheet" href="http://<?= PUBLIC_ROOT ?>assets/css/mainstyles.css">

</head>
<body>
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="http://<?= PUBLIC_ROOT ?>admin/users">Gebruikers</a></li>
        <li><a href="#">Groepen</a></li>
    </ul>
    <ul id="dropdown2" class="dropdown-content">
        <li><a href="http://<?= PUBLIC_ROOT ?>admin/users">Gebruikers</a></li>
        <li><a href="#">Groepen</a></li>
    </ul>
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper teal">
                <a href="#" class="brand-logo">Yellow-Stone</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><?= FontAwesome::Icon('bars', 2);?></a>
                <ul class="right hide-on-med-and-down">
                    <li class="<?= (in_array('home.php', $url_ar) ? 'active' : '')?>"><a href="http://<?= PUBLIC_ROOT ?>">Home <span class="sr-only">(current)</span></a></li>
                    <li class="nav-link <?= (in_array('students', $url_ar) ? 'active' : '')?>"><a href="http://<?= PUBLIC_ROOT ?>students">Klimles Kids</a></li>
                    <li class="nav-link <?= (in_array('trainings', $url_ar) ? 'active' : '')?>"><a href="http://<?= PUBLIC_ROOT ?>trainings">Trainingen</a></li>
                    <?php if($_SESSION['user']->id == 1){?>
                        <li><a class="dropdown-trigger" href="#!" data-target="dropdown2">Admin</i></a></li>
                    <?php } ?>
                    <li><a href='http://<?= PUBLIC_ROOT ?>profile/?user_id=<?=$_SESSION['user']->id?>'>Ingelogd als <?= $_SESSION['user']->name ?></a></li>
                    <li><a href='http://<?=PUBLIC_ROOT?>logout.php' class='btn red'>Log Uit</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <ul class="sidenav" id="mobile-demo">
        <li class="<?= (in_array('home.php', $url_ar) ? 'active' : '')?>"><a href="http://<?= PUBLIC_ROOT ?>">Home <span class="sr-only">(current)</span></a></li>
        <li class="nav-link <?= (in_array('students', $url_ar) ? 'active' : '')?>"><a href="http://<?= PUBLIC_ROOT ?>students">Klimles Kids</a></li>
        <li class="nav-link <?= (in_array('trainings', $url_ar) ? 'active' : '')?>"><a href="http://<?= PUBLIC_ROOT ?>trainings">Trainingen</a></li>
        <?php if($_SESSION['user']->id == 1){?>
            <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Admin</i></a></li>
        <?php } ?>
        <li><a href='http://<?= PUBLIC_ROOT ?>profile/?user_id=<?=$_SESSION['user']->id?>'>Ingelogd als <?= $_SESSION['user']->name ?></a></li>
        <li><a href='http://<?=PUBLIC_ROOT?>logout.php' class='btn red'>Log Uit</a></li>
    </ul>
    <div class="container-fluid">