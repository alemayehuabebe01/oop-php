<?php 

require_once("config/config.php");

class Database{

    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASSWORD;
    private $dbname = DB_NAME;


    private $connection;
    private $error;
    private $stmt;
    private $dbconnection;


    public function __construct(){
          //set pdo connection 
        $dsn = 'mysql:host='. $this->host . ';dbname=' . $this->dbname;
        $option = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );

        try{

            $this->connection = new PDO($dsn, $this->user, $this->pass, $option);
            $this->dbconnection = true;
        }catch(PDOException $e){
         
            $this->error = $e->getMessage().PHP_EOL;
            $this->dbconnection = false;
        }
    }

    function getError(){
        return $this->error;
    }

    function isConnected(){
        return $this->dbconnection;
    }

    //prepare statement with qeury

    public function query($query){
        $this->stmt = $this->connection->prepare($query);
    }

    //Execute the prepared statments
    public function execute(){
        return $this->stmt->execute();
    }

    // Get result set as arry of the object

    public function resultset(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // GET record row count 

    public function rowCount(){
      return  $this->stmt->rowCount();
    }

    // get the single record

    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function bind($param, $value, $type = null){
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
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param,$value,$type);
    }
}
