<?php
require_once '../config.php';

    $adress_id=$_GET['adress_id'];

    $sql = "DELETE FROM adress WHERE adress_id=:adress_id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':adress_id', $adress_id);
    $prep->execute();
    if($prep->execute()){
        echo'user was delited';
        header("Location: /HrSystem/pages/myProfile.php");
    }
    else {
        echo'user was not delited';
    }

    

?>

