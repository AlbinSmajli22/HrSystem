<?php

include_once '../config.php';

$errors = array('NoLeaves' => '');

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

    //var_dump( $User_ID, $leave_type, $duration);
    $requestQuery = "SELECT * FROM amountoftimeoff RIGHT JOIN timeofftype 
                                                        ON amountoftimeoff.time_off_type= timeofftype.id 
                    WHERE user_id =  :user_id and timeofftype.time_off LIKE :leave_type";


    $prep = $con->prepare($requestQuery);
    $prep->bindParam(':user_id', $User_ID, PDO::PARAM_INT);
    $prep->bindParam(':leave_type', $leave_type, PDO::PARAM_STR);

    $prep->execute();
    $timeoffs = $prep->fetch();


    if ($duration > $timeoffs['balance']) {
        $errors['NoLeaves'] = "You don't have enough Leave days";
        

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