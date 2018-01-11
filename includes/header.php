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
    <title>Yellow-stone: Training generator</title>
    <!-- Include Bootstrap, jQuery & Tether-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <!-- Include FontAwesome-->
    <script src="https://use.fontawesome.com/87e743cd60.js"></script>
    <!-- Include jQuery UI-->
    <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Include datatables-->
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>

    <!-- Main styles-->
    <link rel="stylesheet" href="http://<?= PUBLIC_ROOT ?>assets/css/mainstyles.css">

</head>
<body>
    <nav class="navbar navbar-light bg-faded navbar-expand-lg">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Yellow-Stone</a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-md-0">
                <li class="nav-item">
                    <a class="nav-link <?= (in_array('home.php', $url_ar) ? 'active' : '')?>" href="http://<?= PUBLIC_ROOT ?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link <?= (in_array('traininggenerator', $url_ar) ? 'active' : '')?>" href="http://<?= PUBLIC_ROOT ?>traininggenerator">Training Generator</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link <?= (in_array('students', $url_ar) ? 'active' : '')?>" href="http://<?= PUBLIC_ROOT ?>students">Klimles Kids</a>
                </li>
                <?php if($_SESSION['user']->id == 1){?>
                <li class="nav-item dropdown">
                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link <?= (in_array('admin', $url_ar) ? 'active' : '')?>" href="http://<?= PUBLIC_ROOT ?>admin">Admin</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="http://<?= PUBLIC_ROOT ?>admin/users">Gebruikers</a>
                        <a class="dropdown-item" href="#">Groepen</a>
                        <!-- <a class="dropdown-item" href="#">Something else here</a> -->
                    </div>
                </li>
                <?php } ?>
            </ul>
            <span class="navbar-text logged_in_as">
                Ingelogd als <a href='http://<?= PUBLIC_ROOT ?>profile/?user_id=<?=$_SESSION['user']->id?>'><?= $_SESSION['user']->name ?></a>
            </span>
            <a href='http://<?=PUBLIC_ROOT?>logout.php' class='btn btn-danger'>Log Uit</a>
        </div>
    </nav>
    <div class="container-fluid">