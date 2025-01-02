<?php
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];
$Submited="Submited";

$errors = array('file_size' => '', 'file_exist' => '', 'file_format' => '' );


if (isset($_POST['addGoal'])) {
    

      
    $description=$_POST['description'];
    $comments=$_POST['comments'];
    $type=$_POST['type'];
    $due_date=$_POST['due_date'];
    $target_value=$_POST['target'];
    $compleated=0;
    $created=date('y-m-d');

    $addgoalQuery="INSERT INTO goals VALUES (null, :description, :comments, :type, :due_date, :target, :compleated, :created, :user_id)";
    $prep=$con->prepare($addgoalQuery);
   
    $prep->bindParam(':description', $description);
    $prep->bindParam(':comments', $comments);
    $prep->bindParam(':type', $type);
    $prep->bindParam(':due_date', $due_date);
    $prep->bindParam(':compleated', $compleated);
    $prep->bindParam(':target', $target_value);
    $prep->bindParam(':created', $created);
    $prep->bindParam(':user_id', $userId);
    
    $prep->execute();
    header("Location: /HrSystem/pages/goals.php");
   
   
    

}
if (isset($_POST['editGoal'])) {
    
 

}



$goalsQuery = "SELECT * FROM goals
WHERE user_id=:user_id";
$prep = $con->prepare($goalsQuery);
$prep->bindParam(':user_id', $userId);
$prep->execute();
$goals = $prep->fetchAll();


?>