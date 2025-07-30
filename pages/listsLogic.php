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
// Asset Types

// Fetch Asset Types

$assetTypesQuery = "SELECT * FROM assettypes WHERE company_id=:company_id";
$prep = $con->prepare($assetTypesQuery);
$prep->bindParam(':company_id', $companyId);
$prep->execute();
$assetTypes = $prep->fetchAll();

//Add new Asset Type

if (isset($_POST['addAssetType'])) {
    $assettype_name = $_POST['asset'];

    $addAbsenceStatusesQuery = "INSERT INTO assettypes(assettype_id, assettype_name,company_id) VALUES (null, :assettype_name, :company_id)";
    $prep = $con->prepare($addAbsenceStatusesQuery);
    $prep->bindParam(':assettype_name', $assettype_name);
    $prep->bindParam(':company_id', $companyId);
    $prep->execute();

    header("Location: /HrSystem/pages/list.php");
}

//Edit Asset Type
if (isset($_POST['editAssetType'])) {

    $assettype_name = $_POST['asset'];
    $assettype_id = $_POST['assettype_id'];

    $editAbsenceStatusesQuery = " UPDATE  assettypes SET  assettype_name=:assettype_name, company_id=:company_id where assettype_id=:assettype_id";
    $prep = $con->prepare($editAbsenceStatusesQuery);
    $prep->bindParam(':assettype_name', $assettype_name);
    $prep->bindParam(':assettype_id', $assettype_id);
    $prep->bindParam(':company_id', $companyId);

    $prep->execute();

    header("Location: /HrSystem/pages/list.php");

}
//Delete Asset Type
if (isset($_GET['assettype_id'])) {
    $assettype_id = $_GET['assettype_id'];
    $sql = "DELETE FROM assettypes WHERE assettype_id = :assettype_id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':assettype_id', $assettype_id, PDO::PARAM_INT);
    $prep->execute();

    header("Location: /HrSystem/pages/list.php");

}
// Pay Levels

// Fetch Pay Levels

$payLevelsQuery = "SELECT * FROM paylevels WHERE company_id=:company_id";
$prep = $con->prepare($payLevelsQuery);
$prep->bindParam(':company_id', $companyId);
$prep->execute();
$payLevels = $prep->fetchAll();

//Add new Pay Level

if (isset($_POST['addPayLevel'])) {
    $paylevel_name = $_POST['level'];

    $addPayLevelQuery = "INSERT INTO paylevels(paylevel_id, paylevel_name,company_id) VALUES (null, :paylevel_name, :company_id)";
    $prep = $con->prepare($addPayLevelQuery);
    $prep->bindParam(':paylevel_name', $paylevel_name);
    $prep->bindParam(':company_id', $companyId);
    $prep->execute();

    header("Location: /HrSystem/pages/list.php");
}

//Edit Pay Level
if (isset($_POST['editPayLevel'])) {

    $paylevel_name = $_POST['level'];
    $paylevel_id = $_POST['paylevel_id'];

    $editPayLevelQuery = " UPDATE  paylevels SET  paylevel_name=:paylevel_name, company_id=:company_id where paylevel_id=:paylevel_id";
    $prep = $con->prepare($editPayLevelQuery);
    $prep->bindParam(':paylevel_name', $paylevel_name);
    $prep->bindParam(':paylevel_id', $paylevel_id);
    $prep->bindParam(':company_id', $companyId);

    $prep->execute();

    header("Location: /HrSystem/pages/list.php");

}
//Delete Pay Level
if (isset($_GET['paylevel_id'])) {
    $paylevel_id = $_GET['paylevel_id'];
    $sql = "DELETE FROM paylevels WHERE paylevel_id = :paylevel_id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':paylevel_id', $paylevel_id, PDO::PARAM_INT);
    $prep->execute();

    header("Location: /HrSystem/pages/list.php");

}
?>