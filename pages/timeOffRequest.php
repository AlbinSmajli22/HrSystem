<?php

include_once './config.php';


if (isset($_POST['enter'])) {

    $User_ID=$_SESSION['user_id'];
    $Head_ID=$_SESSION['report_to'];
    $leave_type = $_POST['LeaveType'];
    $from=$_POST['from'];
    $to = $_POST['to'];
    $duration=$_POST['duration'];
    $short_description=$_POST['shortDescription'];
    $reason=$_POST['reason'];
    $status=$_POST['status'];
    $created=date('y/m/d');
    
    $sql="INSERT into timeoffrequests values ( null,:User_Id, :Head_Id, :leave_type, :from, :to, :duration, :short_description, :reason, :status, null, null, :created) ";

    $prep = $con->prepare($sql);
    $prep->bindParam(':User_Id', $User_ID);
    $prep->bindParam(':Head_Id', $Head_ID);
    $prep->bindParam(':leave_type', $leave_type);
    $prep->bindParam(':from', $from);
    $prep->bindParam(':to', $to);
    $prep->bindParam(':duration', $duration);
    $prep->bindParam(':short_description', $short_description);
    $prep->bindParam(':reason', $reason);
    $prep->bindParam(':status', $status);
    $prep->bindParam(':created', $created);

    $prep->execute();

    
}

?>