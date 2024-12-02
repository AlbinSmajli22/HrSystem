<?php
require_once '../config.php';

    $expensse_id=$_GET['expensse_id'];

    $sql = "DELETE FROM expenses WHERE id=:expensse_id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':expensse_id', $expensse_id);
    $prep->execute();
    if($prep->execute()){
        echo'expensse was delited';
        header("Location: /HrSystem/pages/empexpenses.php");
    }
    else {
        echo'expensse was not delited';
    }

    

?>

