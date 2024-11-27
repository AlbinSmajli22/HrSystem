<?php
require_once '../config.php';

    $expense_id=$_GET['expense_id'];

    $sql = "DELETE FROM expensescategory WHERE id=:id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':id', $expense_id);
    $prep->execute();
    if($prep->execute()){
        echo'user was delited';
        header("Location: /HrSystem/pages/configureExpenses.php");
    }
    else {
        echo'user was not delited';
    }

    

?>

