<?php 

require_once("Database.php");

$db = new Database();
echo $db->isConnected() ? "Database Connected Successfully" . PHP_EOL : "Database Not Connected". PHP_EOL;

if(!$db->isConnected()){
    echo $db->getError();
    die("Unable to connect to Data base");

}

$db->query("SELECT * FROM tbl_oop_test");
var_dump(($db->resultset()));
echo "Row Count : ". $db->rowCount();
var_dump($db->single());

$db->query("SELECT * FROM tbl_oop_test where id = :id");
$db->bind("id", 2);

var_dump($db->single());


