<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'hrsystem';

try{

$con= new PDO("mysql:host=$host; dbname=$db;", $user, $password);

}
catch(Exception $e){
    echo "error ".$e;
}
?>