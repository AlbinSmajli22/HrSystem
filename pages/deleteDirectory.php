<?php
require_once '../config.php';

    $id=$_GET['id'];

    $sql = "DELETE FROM users WHERE id=:id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':id', $id);
    $prep->execute();
    if($prep->execute()){
        echo'user was delited';
        header("Location: ../main.php?page=directory");
    }
    else {
        echo'user was not delited';
    }

    

?>

