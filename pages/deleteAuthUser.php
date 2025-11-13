<?php
require_once '../config.php';

    $admin_id=$_GET['admin_id'];

    $sql = "DELETE FROM admins WHERE admin_id=:admin_id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':admin_id', $admin_id);
    $prep->execute();
    if($prep->execute()){
        echo'user was delited';
        header("Location: /HrSystem/pages/authorisedUsers.php");
    }
    else {
        echo'user was not delited';
    }

    

?>