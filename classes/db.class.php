<?php
     class DB{  
         static private $conn = null;
         static private function getConnection(){
            // make db connection
            $servername = "localhost";
            $username = "silkmedi_nick";
            $password = "Renoob2312";
            
            try {
                $conn = new PDO("mysql:host=$servername;dbname=silkmedi_ys", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
                }
            catch(PDOException $e)
                {
                echo "Connection failed: " . $e->getMessage();
                return false;
                }
         }

         static public function executeInsertQuery($query, array $pdo_parameters_ar = array()){
            self::executeQuery($query, $pdo_parameters_ar);
            $id = self::$conn->lastInsertId();
            return $id;
         }

         static public function executeQuery($query, array $pdo_parameters_ar = array()){
            self::$conn = self::getConnection();
            $stmt = self::$conn->prepare($query);
            foreach($pdo_parameters_ar as $key => &$value){
                $stmt->bindParam($key, $value);
            }
            return $stmt->execute();
         }

         static public function fetch(){

         }
         
        static public function fetchAll($query, array $pdo_parameters_ar = array()){
            self::$conn = self::getConnection();
            $stmt = self::$conn->prepare($query);
            foreach($pdo_parameters_ar as $key => &$value){
                $stmt->bindParam($key, $value);
            } 
            $stmt->execute();
            return  $stmt->fetchAll(PDO::FETCH_OBJ);
         }

         static public function fetchKeyPair($query, array $pdo_parameters_ar = array()){
            self::$conn = self::getConnection();
            $stmt = self::$conn->prepare($query);
            foreach($pdo_parameters_ar as $key => &$value){
                $stmt->bindParam($key, $value);
            } 
            $stmt->execute();
            return  $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
         }
     }   
?>