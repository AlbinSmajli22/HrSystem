<?php
require_once '../config.php';
$request_id=$_GET['request_id'];

$sql = "DELETE FROM timeoffrequests WHERE request_id=:request_id";
$prep = $con->prepare($sql);
$prep->bindParam(':request_id', $request_id);
$prep->execute();
if($prep->execute()){
    echo'request was delited';
    header("Location: ../main.php?page=request");
}
else {
    echo'user was not delited';
}
?>