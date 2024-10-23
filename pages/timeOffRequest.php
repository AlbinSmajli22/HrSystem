<?php

include_once '../config.php';

$userId = $_SESSION['user_id'];


if (isset($_POST['enter'])) {

    $User_ID = $_SESSION['user_id'];
    $Head_ID = $_SESSION['report_to'];
    $leave_type = $_POST['LeaveType'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $duration = $_POST['duration'];
    $short_description = $_POST['shortDescription'];
    $reason = $_POST['reason'];
    $status = $_POST['status'];
    $created = date('y/m/d');


    $requestQuery = "SELECT * FROM amountoftimeoff RIGHT JOIN timeofftype 
                    ON amountoftimeoff.time_off_type= timeofftype.id 
                WHERE user_id = $userId and timeofftype.time_off =  $leave_type";

    $prep = $con->prepare($requestQuery);
    $prep->execute();
    $timeoffs = $prep->fetch();


    if ($duration > $timeoffs['balance']) {
        echo "nuk keni dit te mjaftueshme pushimi";
    
    } else {



        $sql = "INSERT into timeoffrequests values ( null,:User_Id, :Head_Id, :leave_type, :from, :to, :duration, :short_description, :reason, :status, null, null, :created) ";

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
}
?>