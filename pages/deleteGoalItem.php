<?php
require_once '../config.php';

    $goal_id=$_GET['goal_id'];

    $sql = "DELETE FROM goalitems WHERE id=:id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':id', $goal_id);
    $prep->execute();
    if($prep->execute()){
        echo'user was delited';
        header("Location: goalItem.php");
    }
    else {
        echo'goal was not delited';
    }

    

?>

