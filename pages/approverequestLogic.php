<?php

if (isset($_POST['Approve'])) {
    $leave_type = $_POST['leave_type'];
    $request_id = $_POST['request_id'];
    $User_ID = $_POST['requestUserId'];
    $status = 'Approved';
    $duration = $_POST['duration'];
    $checkedby = $_SESSION['user_id'];
    $checkDate = date("Y-m-d");
    


    $updatetimeoffsql = "UPDATE amountoftimeoff RIGHT JOIN timeofftype 
                                    ON amountoftimeoff.time_off_type= timeofftype.id
                                SET amountoftimeoff.balance = amountoftimeoff.balance - (:balance), amountoftimeoff.available = amountoftimeoff.available - (:balance)
                                WHERE user_id = :user_id  and timeofftype.time_off LIKE :time_off";
        $prep = $con->prepare($updatetimeoffsql);
        $prep->bindParam(':user_id', $User_ID, PDO::PARAM_INT);
        $prep->bindParam(':time_off', $leave_type, PDO::PARAM_STR);
        $prep->bindParam(':balance', $duration, PDO::PARAM_STR);
        $prep->execute();



    $sql = " UPDATE timeoffrequests SET status=:status, checkedby=:checkedby, checkDate=:checkDate WHERE request_id=:request_id";

    $prep = $con->prepare($sql);

    $prep->bindParam("request_id", $request_id);
    $prep->bindParam(':status', $status);
    $prep->bindParam(':checkedby', $checkedby);
    $prep->bindParam(':checkDate', $checkDate);
    $prep->execute();

  
        

 
        echo "<script> setTimeout(function() { window.location = 'approverequest.php'; }, 100); </script>  ";

} else if (isset($_POST['Decline'])) {
    $leave_type = $_POST['leave_type'];
    $request_id = $_POST['request_id'];
    $User_ID = $_POST['requestUserId'];
    $status = 'Declined';
    $duration = $_POST['duration'];
    $checkedby = $_SESSION['user_id'];
    $checkDate = date("Y-m-d");
    $prep->execute();

    $sql = " UPDATE timeoffrequests SET status=:status, checkedby=:checkedby, checkDate=:checkDate WHERE request_id=:request_id";

    $prep = $con->prepare($sql);

    $prep->bindParam("request_id", $request_id);
    $prep->bindParam(':status', $status);
    $prep->bindParam(':checkedby', $checkedby);
    $prep->bindParam(':checkDate', $checkDate);
    $prep->execute();

    echo "<script> setTimeout(function() { window.location = 'approverequest.php'; }, 100); </script>  ";
}
