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

    public function getError(){
        return $this->error_message;
    }

    public function isConnected(){
        return $this->dbConnection;
    }
    
    public function query($sql){
        $this->stmt = $this->connection->prepare($sql);
    }

    public function execute(){
       return $this->stmt->execute();
    }

    public function fetch($sql){
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function rowCount(){
        $this->stmt->execute();
        return $this->stmt->rowCount();
    }

    public function singleFetch(){
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function bind($param, $value , $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                $type =  PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param,$value,$type);
    }

    







}