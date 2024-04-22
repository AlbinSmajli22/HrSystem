<?php

include_once './config.php';

$userId = $_SESSION['user_id'];

$sql2 = "SELECT * from timeoff WHERE User_ID = $userId";

$prep = $con->prepare($sql2);
$prep->execute();
$timeoffs = $prep->fetch();

$annualLeave = $timeoffs["annual_leave"];
$childBorn = $timeoffs["child_born"];
$deathOfFamilyMember = $timeoffs["death_of_family_member"];
$movingDay = $timeoffs["moving_day"];
$weddingDay = $timeoffs["wedding_day"];
$sickLeave = $timeoffs["sick_leave"];


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



if ($leave_type == "Annual Leave" && $duration > $annualLeave) {
    echo "nuk keni dit te mjaftueshme pushimi";
} else if ($leave_type == "Child Born" && $duration > $childBorn) {
    echo "nuk keni dit te mjaftueshme pushimi";
} else if ($leave_type == "Death of Family Member" && $duration > $deathOfFamilyMember) {
    echo "nuk keni dit te mjaftueshme pushimi";
} else if ($leave_type == "Moving Day" && $duration > $movingDay) {
    echo "nuk keni dit te mjaftueshme pushimi";
} else if ($leave_type == "Wedding Day" && $duration > $weddingDay) {
    echo "nuk keni dit te mjaftueshme pushimi";
} else if ($leave_type == "Sick Leave" && $duration > $sickLeave) {
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