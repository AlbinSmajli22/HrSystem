<?php
require_once '../config.php';

    $goal_id=$_GET['goal_id'];

    $sql = "DELETE FROM goals WHERE id=:goal_id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':goal_id', $goal_id);
    $prep->execute();
    if($prep->execute()){
        echo'user was delited';
        header("Location: goals.php");
    }
    else {
        echo'goal was not delited';
    }

    

?>

