<?php
    class Protect{
        static public function mustBeLoggedIn(){
            if(!isset($_SESSION['user'])){
                header('Location: http://'.PUBLIC_ROOT.'index.php');
                exit();
            }
        }

        static public function mustNotBeLoggedIn(){
            if(isset($_SESSION['user'])){
                header('Location: http://'.PUBLIC_ROOT.'home.php');
                exit();
            }
        }
    }
?>