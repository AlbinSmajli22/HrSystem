<?php

include_once './config.php';


if (isset($_POST['enter'])) {

    $User_ID=17;
    $Head_ID=21;
    $leave_type = 'annual leave';
    $from=date(2023-12-27);
    $to = date(2023-12-29);
    $duration=2;
    $short_description='asdasdas';
    $reason='sadasdsa';
    $status='submited';
    
    $sql="INSERT into timeoffrequests values ( null,:User_Id, :Head_Id, :leave_type, :from, :to, :duration, :short_description, :reason, :status) ";

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

    $prep->execute();


}

?>