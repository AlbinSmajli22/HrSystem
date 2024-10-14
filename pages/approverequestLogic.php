<?php

if (isset($_POST['Approve'])){
    $leave_type =$_POST['leave_type']; 
    $request_id=$_POST['request_id'];
    $User_ID=$_POST['requestUserId'];
    $status='Approved';
    $duration=$_POST['duration'];
    $checkedby=$_SESSION['user_id'];
    $checkDate = date("Y-m-d");
    $prep->execute();

    $sql=" UPDATE timeoffrequests SET status=:status, checkedby=:checkedby, checkDate=:checkDate WHERE request_id=:request_id";

    $prep = $con->prepare($sql);

    $prep->bindParam("request_id", $request_id);
    $prep->bindParam(':status', $status);
    $prep->bindParam(':checkedby', $checkedby);
    $prep->bindParam(':checkDate', $checkDate);
    $prep->execute();

    if($leave_type === "Annual Leave"){
    $updatetimeoffsql = "UPDATE timeoff set annual_leave = annual_leave - ($duration)
        where User_ID = $User_ID";
        $prep = $con->prepare($updatetimeoffsql);
        $prep->execute();
       
    }elseif($leave_type === "Child Born"){
        $updatetimeoffsql = "UPDATE timeoff set child_born = child_born - ($duration)
        where User_ID = $User_ID";
        $prep = $con->prepare($updatetimeoffsql);
        $prep->execute();
    }
   elseif($leave_type === "Death of Family Member"){
        $updatetimeoffsql = "UPDATE timeoff set death_of_family_member = death_of_family_member - ($duration)
        where User_ID = $User_ID";
        $prep = $con->prepare($updatetimeoffsql);
        $prep->execute();
    }
    elseif($leave_type === "Moving Day"){
        $updatetimeoffsql = "UPDATE timeoff set moving_day = moving_day - ($duration)
        where User_ID = $User_ID";
        $prep = $con->prepare($updatetimeoffsql);
        $prep->execute();
    }
    elseif($leave_type === "Wedding Day"){
        $updatetimeoffsql = "UPDATE timeoff set wedding_day = wedding_day - ($duration)
        where User_ID = $User_ID";
        $prep = $con->prepare($updatetimeoffsql);
        $prep->execute();
    }
   elseif($leave_type === "Sick Leave"){
        $updatetimeoffsql = "UPDATE timeoff set sick_leave = sick_leave - ($duration)
        where User_ID = $User_ID";
        $prep = $con->prepare($updatetimeoffsql);
        $prep->execute();

    }else{
        echo "<Script> alert('somthing went wrong') </Script> ";
    }
        echo "<script> setTimeout(function() { window.location = 'main.php?page=approve'; }, 100); </script>  ";
    
}else if (isset($_POST['Decline'])){
    $leave_type =$_POST['leave_type']; 
    $request_id=$_POST['request_id'];
    $User_ID=$_POST['requestUserId'];
    $status='Declined';
    $duration=$_POST['duration'];
    $checkedby=$_SESSION['user_id'];
    $checkDate = date("Y-m-d");
    $prep->execute();

    $sql=" UPDATE timeoffrequests SET status=:status, checkedby=:checkedby, checkDate=:checkDate WHERE request_id=:request_id";

    $prep = $con->prepare($sql);

    $prep->bindParam("request_id", $request_id);
    $prep->bindParam(':status', $status);
    $prep->bindParam(':checkedby', $checkedby);
    $prep->bindParam(':checkDate', $checkDate);
    $prep->execute();

    echo "<script> setTimeout(function() { window.location = 'main.php?page=approve'; }, 100); </script>  ";
}
