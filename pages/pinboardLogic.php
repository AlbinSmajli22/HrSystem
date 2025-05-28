<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];

if (isset($_POST['addnote'])) {

    $title=$_POST['title'];
    $body=$_POST['body'];
    $today=date('y-m-d h:i:s');

    $sql="INSERT INTO notes (notes_id, title, body, created, user, company) VALUES (null, :title, :body, :created, :user, :company)";
    $prep=$con->prepare($sql);
    $prep->bindParam(':title',$title );
    $prep->bindParam(':body', $body);
    $prep->bindParam(':created', $today);
    $prep->bindParam(':user', $userId);
    $prep->bindParam(':company', $companyId);

    $prep->execute();
    
    header("Location: /HrSystem/pages/pinboard.php");

}

?>