<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];

if (isset($_POST['assignGoal'])) {

    $name=$_POST['name'];
    $description=$_POST['details'];
    $type=$_POST['type'];
    $due_date=$_POST['dueDate'];
    $created=date('y-m-d');
    $target_value=$_POST['target'];
    $users=$_POST['selected_values'];

    $asignGoalQuery="INSERT INTO companygoals (id, name, description, comments, type, due_date, created,
    target_value, compleated, value, company_id, users) VALUES(null, :name, :description, null, :type, :due_date,
    :created, :target_value, null, null, :company_id, :users)";
    
    $prep = $con->prepare($asignGoalQuery);
    $prep->bindParam(':company_id', $companyId);
    $prep->bindParam(':name', $name);
    $prep->bindParam(':description', $description);
    $prep->bindParam(':type', $type);
    $prep->bindParam(':due_date', $due_date);
    $prep->bindParam(':created', $created);
    $prep->bindParam(':target_value', $target_value);
    $prep->bindParam(':users', $users);

    $prep->execute();
    
    header("Location: /HrSystem/pages/assignesGoals.php");
}

?>
