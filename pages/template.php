<?php
require_once '../config.php';
session_start();
include 'addNewGoal.php';


$sql = "SELECT u.user_id, u.image from users u where user_id=$userId";

$prep = $con->prepare($sql);
$prep->execute();
$userImages = $prep->fetchAll();

?>

