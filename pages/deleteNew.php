<?php
require_once '../config.php';

    $new_id=$_GET['new_id'];

    $sql = "DELETE FROM news WHERE new_id=:new_id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':new_id', $new_id);
    $prep->execute();
    if($prep->execute()){
        echo'news was delited';
        header("Location: news.php");
    }
    else {
        echo'news was not delited';
    }

    

?>

