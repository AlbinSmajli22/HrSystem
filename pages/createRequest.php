<?php

include_once './config.php';



if(isset($_POST['submit'])){


    $User_ID = $_POST['user_id'];
    $Head_ID = $_POST['head_id'];
    $leave_type = $_POST['LeaveType'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $duration = $_POST['duration'];
    $short_description = $_POST['shortDescription'];
    $reason = $_POST['reason'];
    $status = $_POST['status'];
   
    
    $sql = "INSERT INTO timeoffrequests (User_ID, Head_ID, leave_type, from, to, duration, short_description, reason, status) VALUES (:User_ID, :Head_ID, :leave_type, :from,:to,:duration,:short_description, :reason, :status, :status)";
    
    $prep = $con->prepare($sql);


    $prep->bindParam(':User_ID', $User_ID);
    $prep->bindParam(':Head_ID', $Head_ID);
    $prep->bindParam(':leave_type', $leave_type);
    $prep->bindParam(':from', $from);
    $prep->bindParam(':to', $to);
    $prep->bindParam(':duration', $duration);
    $prep->bindParam(':short_description', $short_description);
    $prep->bindParam(':reason', $reason);
    $prep->bindParam(':status', $status);
    
    $prep->execute();
    
    Header("Location:main.php");
}
?>