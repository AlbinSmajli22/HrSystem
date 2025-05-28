<?php
require_once '../config.php';

    $notes_id=$_GET['notes_id'];

    $sql = "DELETE FROM notes WHERE notes_id=:notes_id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':notes_id', $notes_id);
    $prep->execute();
    if($prep->execute()){
        echo'user was delited';
        header("Location: /HrSystem/pages/pinboard.php");
    }
    else {
        echo'note was not delited';
    }

    

?>

