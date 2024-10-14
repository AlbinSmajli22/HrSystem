<?php
require_once '../config.php';

    $user_id=$_GET['user_id'];

    $sql = "DELETE FROM users WHERE user_id=:user_id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':user_id', $user_id);
    $prep->execute();
    if($prep->execute()){
        echo'user was delited';
        header("Location: directory.php");
    }
    else {
        echo'user was not delited';
    }

    

?>

