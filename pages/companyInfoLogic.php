<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];


$sql="SELECT * FROM company WHERE company_id=:company_id";
$prep=$con->prepare($sql);
$prep->bindParam(':company_id',$companyId);
$prep->execute();
$companyInfo=$prep->fetch();

// These come from your database
$selectedCountry = $companyInfo['country'];
$selectedTimezone = $companyInfo['timezone'];

?>