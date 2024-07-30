<?php
include_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];

if (isset($_POST['saveContact'])) {



    $contact_type = $_POST['contact_type'];
    $details = $_POST['details'];

    if ($_POST['primary_contact']==1) {
        $primary_contact = $_POST['primary_contact'];
    }else{
        $primary_contact = '0';
    };
    if ($_POST['public']==1) {
        $public = $_POST['public'];
    }else{
        $public  = '0';
    };
    if ($_POST['emergency']==1) {
        $emergency = $_POST['emergency'];
    }else{
        $emergency = '0';
    };
    $extra_info = $_POST['extra_info'];
    $user_id = $userId;

    $addAddressQuery = "INSERT INTO `contact` (contact_type, details, primary_contact, public, emergency, extra_info, user_id) VALUES (:contact_type, :details, :primary_contact, :public, :emergency, :extra_info, :user_id)";

    $prep = $con->prepare($addAddressQuery);

    $prep->bindParam(':contact_type', $contact_type);
    $prep->bindParam(':details', $details);
    $prep->bindParam(':primary_contact', $primary_contact);
    $prep->bindParam(':public', $public);
    $prep->bindParam(':emergency', $emergency);
    $prep->bindParam(':extra_info', $extra_info);
    $prep->bindParam(':user_id', $user_id);

    $prep->execute();
    Header("Location:/HrSystem/pages/myProfile.php");
 
}


if(isset($_POST['editContact'])){
    
    $contact_id = $_POST['contact_id'];
    $contact_type = $_POST['contact_type'];
    $details = $_POST['details'];

    if ($_POST['primary_contact']==1) {
        $primary_contact = $_POST['primary_contact'];
    }else{
        $primary_contact = '0';
    }
    if ($_POST['public']==1) {
        $public = $_POST['public'];
    }else{
        $public  = '0';
    }
    if ($_POST['emergency']==1) {
        $emergency = $_POST['emergency'];
    }else{
        $emergency = '0';
    }
    $extra_info = $_POST['extra_info'];


    $editAddressQuery = "UPDATE `contact` SET contact_type=:contact_type, details=:details, primary_contact=:primary_contact, public=:public, emergency=:emergency, extra_info=:extra_info WHERE contact_id=:contact_id";

    $prep = $con->prepare($editAddressQuery);


    $prep->bindParam(':contact_id', $contact_id);
    $prep->bindParam(':contact_type', $contact_type);
    $prep->bindParam(':details', $details);
    $prep->bindParam(':primary_contact', $primary_contact);
    $prep->bindParam(':public', $public);
    $prep->bindParam(':emergency', $emergency);
    $prep->bindParam(':extra_info', $extra_info);
   
    

    $prep->execute();
    Header("Location:/HrSystem/pages/myProfile.php");


}

if (isset($_POST['removePrimary'])) {

    $contact_id = $_POST['contact_id'];

    $editAddressQuery = "UPDATE `contact` SET primary_contact=0 WHERE contact_id=:contact_id";
    $prep = $con->prepare($editAddressQuery);

    $prep->bindParam(':contact_id', $contact_id);

    $prep->execute();
    Header("Location:/HrSystem/pages/myProfile.php");
}
if (isset($_POST['makePrimary'])) {

    $contact_id = $_POST['contact_id'];

    $editAddressQuery = "UPDATE `contact` SET primary_contact=1 WHERE contact_id=:contact_id";
    $prep = $con->prepare($editAddressQuery);

    $prep->bindParam(':contact_id', $contact_id);

    $prep->execute();
    Header("Location:/HrSystem/pages/myProfile.php");
}
if (isset($_POST['removePublic'])) {

    $contact_id = $_POST['contact_id'];

    $editAddressQuery = "UPDATE `contact` SET public=0 WHERE contact_id=:contact_id";
    $prep = $con->prepare($editAddressQuery);

    $prep->bindParam(':contact_id', $contact_id);

    $prep->execute();
    Header("Location:/HrSystem/pages/myProfile.php");
}
if (isset($_POST['makePublic'])) {

    $contact_id = $_POST['contact_id'];

    $editAddressQuery = "UPDATE `contact` SET public=1 WHERE contact_id=:contact_id";
    $prep = $con->prepare($editAddressQuery);

    $prep->bindParam(':contact_id', $contact_id);

    $prep->execute();
    Header("Location:/HrSystem/pages/myProfile.php");
}
?>