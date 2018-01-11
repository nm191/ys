<?php
    class dd{
        static public function show($content){
            echo '<pre>';
            var_dump($content);
            die();
        }
    }
?>