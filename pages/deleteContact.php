<?php
require_once '../config.php';
$contact_id=$_GET['contact_id'];

$sql = "DELETE FROM contact WHERE contact_id=:contact_id";
$prep = $con->prepare($sql);
$prep->bindParam(':contact_id', $contact_id);
$prep->execute();
if($prep->execute()){
    echo'request was delited';
    header("Location: /HrSystem/pages/myProfile.php");
}
else {
    echo'user was not delited';
}
?>