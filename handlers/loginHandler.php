<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/ys/classes/config.php');

    // check if request method is post. If not, its not the right way to access this script.
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        exit(false);
    }

    //check if fields are filled
    if(empty($_POST['email'] || empty($_POST['password']))){
        exit(false);
    }

    //check if username exists in database
    $records_ar = DB_Users_Users::getFullRecords(array('email' => $_POST['email']));
    if(empty($records_ar)){
        exit('username not found');
    }

    $record = reset($records_ar);

    //check if password is correct
    if(!password_verify($_POST['password'], $record->password)){
        exit(false);
    }

    //fill session with user details
    $_SESSION['user'] = $record;
    
    exit(true);
    
?>