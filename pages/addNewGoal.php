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

    $addgoalQuery="INSERT INTO `goals` (id, description, comments, type, due_date, target_value, value, user_id, compleated, created, updated, notes) 
                    VALUES (null, :description, :comments, :type, :due_date, :target, null, :user_id, :compleated ,:created, null, null)";
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
    $value=$_POST['value'];
    $notes=$_POST['notes'];
    $goal_id=$_POST['goal_id'];


    $editgoalQuery="UPDATE `goals` SET notes=:notes, value=:value where id=:goal_id";
    $prep=$con->prepare($editgoalQuery);

    $prep->bindParam(':notes',$notes);
    $prep->bindParam(':value', $value);
    $prep->bindParam(':goal_id', $goal_id);

    $prep->execute();
}



$goalsQuery = "SELECT * FROM goals
WHERE user_id=:user_id";
$prep = $con->prepare($goalsQuery);
$prep->bindParam(':user_id', $userId);
$prep->execute();
$goals = $prep->fetchAll();


?>