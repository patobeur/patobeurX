<?php
    class Database{           
        if ($_SERVER['HTTP_HOST'] == ''){
          private $host = "";
          private $db_name = "";
          private $username = "";
          private $password = "";
        }
        elseif $_SERVER['HTTP_HOST'] == 'localhost'){
          private $host = "localhost";
          private $db_name = "";
          private $username = "";
          private $password = "";
        }
        else{
          // DIE
          die;
        }
        
        private static $cont = null;
        Public static $cont2 = null;
        Public static $cont3 = array();
    
        public $conn;
    
        public function dbConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }
            return $this->conn;
        }
    
        public static function connect(){
            // Autoriser une seule connexion pour toute la durée de l’accès
            if ( null == self::$cont ){
              try{
                self::$cont = new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
              }
              catch(PDOException $e){
                die($e->getMessage());
              }
            }
            return self::$cont;
        }
    }
?>