<?php

require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];



// Absence Statuses

// Fetch Absence Statuses

$absenceStatusesQuery = "SELECT * FROM absencestatuses WHERE company_id=:company_id";
$prep = $con->prepare($absenceStatusesQuery);
$prep->bindParam(':company_id', $companyId);
$prep->execute();
$absenceStatuses = $prep->fetchAll();

//Add new Absence Status

if (isset($_POST['addAbsenceStatus'])) {
    $absencestatus_name = $_POST['absence'];

    $addAbsenceStatusesQuery = "INSERT INTO absencestatuses(absencestatus_id, absencestatus_name,company_id) VALUES (null, :absencestatus_name, :company_id)";
    $prep = $con->prepare($addAbsenceStatusesQuery);
    $prep->bindParam(':absencestatus_name', $absencestatus_name);
    $prep->bindParam(':company_id', $companyId);
    $prep->execute();

    header("Location: /HrSystem/pages/list.php");
}

//Edit Absence Status
if (isset($_POST['editAbsenceStatus'])) {

    $absencestatus_name = $_POST['absence'];
    $absencestatus_id = $_POST['absencestatus_id'];

    $editAbsenceStatusesQuery = " UPDATE  absencestatuses SET  absencestatus_name=:absencestatus_name, company_id=:company_id where absencestatus_id=:absencestatus_id";
    $prep = $con->prepare($editAbsenceStatusesQuery);
    $prep->bindParam(':absencestatus_name', $absencestatus_name);
    $prep->bindParam(':absencestatus_id', $absencestatus_id);
    $prep->bindParam(':company_id', $companyId);

    $prep->execute();

    header("Location: /HrSystem/pages/list.php");

}
//Delete Absence Status
if (isset($_GET['absencestatus_id'])) {
    $absencestatus_id = $_GET['absencestatus_id'];
    $sql = "DELETE FROM absencestatuses WHERE absencestatus_id = :absencestatus_id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':absencestatus_id', $absencestatus_id, PDO::PARAM_INT);
    $prep->execute();

    header("Location: /HrSystem/pages/list.php");

}
?>