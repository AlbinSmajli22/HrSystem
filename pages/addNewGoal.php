<?php
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];
$Submited="Submited";
$userIdJson = json_encode($userId);

$errors = array('file_size' => '', 'file_exist' => '', 'file_format' => '' );


if (isset($_POST['addGoal'])) {
      
    $description=$_POST['description'];
    $comments=$_POST['comments'];
    $type=$_POST['type'];
    $due_date=$_POST['due_date'];
    $target_value=$_POST['target'];
    $completed=0;
    $created=date('y-m-d');

    $addgoalQuery="INSERT INTO `goals` (id, description, comments, type, due_date, target_value, value, user_id, compleated, created, updated, notes) 
                    VALUES (null, :description, :comments, :type, :due_date, :target, null, :user_id, :completed ,:created, null, null)";
    $prep=$con->prepare($addgoalQuery);
   
    $prep->bindParam(':description', $description);
    $prep->bindParam(':comments', $comments);
    $prep->bindParam(':type', $type);
    $prep->bindParam(':due_date', $due_date);
    $prep->bindParam(':completed', $completed);
    $prep->bindParam(':target', $target_value);
    $prep->bindParam(':created', $created);
    $prep->bindParam(':user_id', $userId);
    
    $prep->execute();
    header("Location: /HrSystem/pages/goals.php");
   
   
    

}
if (isset($_POST['editGoal'])) {
    $value=!empty($_POST['value']) ? $_POST['value'] : null;
    $notes=$_POST['notes'];
    $goal_id=$_POST['goal_id'];
    $updated=date('y-m-d');
    $completed=isset($_POST['complete']) ? $_POST['complete'] : null;


    $editgoalQuery="UPDATE `goals` SET notes=:notes, value=:value, updated=:updated where id=:goal_id";
    $prep=$con->prepare($editgoalQuery);

    $prep->bindParam(':notes',$notes);
    $prep->bindParam(':value', $value);
    $prep->bindParam(':goal_id', $goal_id);
    $prep->bindParam(':updated', $updated);
    $prep->bindParam(':completed', $completed);

    $prep->execute();
}
if (isset($_POST['editCompanyGoal'])) {
    $value=!empty($_POST['value']) ? $_POST['value'] : null;
    $goal_id=$_POST['goal_id'];
    $comment=$_POST['comment'];
    $completed=isset($_POST['complete']) ? $_POST['complete'] : null;


    $editgoalQuery="INSERT INTO companygoalsvalue (id, user, company_goal, value, completed, comment)
    VALUES (null, :user, :company_goal, :value, :completed, :comment)";

    $prep=$con->prepare($editgoalQuery);

    $prep->bindParam(':user',$userId);
    $prep->bindParam(':value', $value);
    $prep->bindParam(':company_goal', $goal_id);
    $prep->bindParam(':comment', $comment);
    $prep->bindParam(':completed', $completed);

    $prep->execute();
}



$goalsQuery = "SELECT * FROM goals Right Join users on goals.user_id=users.user_id
WHERE goals.user_id=:user_id and (value IS NULL AND completed IS NULL)";
$prep = $con->prepare($goalsQuery);
$prep->bindParam(':user_id', $userId);
$prep->execute();
$goals = $prep->fetchAll();




/**SELECT * FROM companygoals 
WHERE JSON_CONTAINS(users, :userId) 
AND NOT EXISTS (
    SELECT 1 FROM companygoalsvalue 
    WHERE company_goal = companygoals.id 
    AND user = :userId
)
AND (completed IS NULL OR completed = 0); */

$companyGoalsQ = "SELECT * FROM companygoals 
WHERE JSON_CONTAINS(users, :userId) 
AND NOT EXISTS (
    SELECT 1 FROM companygoalsvalue 
    WHERE company_goal = companygoals.id 
    AND user = :userIdRAW
)
AND (completed IS NULL OR completed = 0);";
$prep = $con->prepare($companyGoalsQ);
$prep->bindParam(':userId', $userIdJson, PDO::PARAM_STR);
$prep->bindParam(':userIdRAW', $userId, PDO::PARAM_STR);
$prep->execute();
$comapnygoals = $prep->fetchAll(PDO::FETCH_ASSOC);




?>