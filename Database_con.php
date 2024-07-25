<?php 

require_once("config/config.php");

class DatabaseCon{

    private $database_name = DB_NAME;
    private $database_user = DB_USER;
    private $database_password = DB_PASSWORD;
    private $database_host = DB_HOST;

    private $error_message;
    private $dbConnection;
    private $connection;

    private $stmt;


    public function __construct(){
        //here to set database connection
        $dsn = 'mysql:database_host='.$this->database_host.';database_name='. $this->database_name;
        $option = array(
            PDO::ATTR_PERSISTENT =>true,
            PDO::ATTR_ERRMODE  =>PDO::ERRMODE_EXCEPTION);
        
        try{
            $this->connection= new PDO($dsn, $this->database_user, $this->database_password, $option);
            $this->dbConnection = true;
        }catch(PDOException $e){
            $this->error_message = $e->getMessage().PHP_EOL;
            $this->dbConnection = false;
        }

    }

    



}