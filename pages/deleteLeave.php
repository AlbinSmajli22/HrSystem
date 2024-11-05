<?php
require_once '../config.php';

    $leave_id=$_GET['leave_id'];

    $sql = "DELETE FROM timeofftype WHERE id=:leave_id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':leave_id', $leave_id);
    $prep->execute();
    if($prep->execute()){
        echo'user was delited';
        header("Location: configureLeaves.php");
    }
    else {
        echo'user was not delited';
    }

    

?>

