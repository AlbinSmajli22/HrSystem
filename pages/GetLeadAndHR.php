<?php
$leaderID = $_SESSION['report_to'];
$userId=$_SESSION['user_id'];



$sql2 ="SELECT * from users WHERE User_ID = $leaderID";

$prep= $con->prepare($sql2);
$prep->execute();
$teamLeader= $prep->fetch();

$leaderName = $teamLeader["name"];
$leaderSurname = $teamLeader["surname"];

$HR = $_SESSION['HR'];
?>