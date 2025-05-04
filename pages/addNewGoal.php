<?php
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];
$Submited = "Submited";
$userIdJson = json_encode($userId);


$errors = array('file_size' => '', 'file_exist' => '', 'file_format' => '');



if (isset($_POST['addGoalItem'])) {

    $description = $_POST['description'];
    $comments = $_POST['comments'];
    $type = $_POST['type'];
    $due_date = $_POST['due_date'];
    $target_value = $_POST['target'];
    $created = date('y-m-d');

    $additeamQuery = "INSERT INTO `goalitems` (id, name, details, type, due_deadline, target, created, updated, company_id, status) 
                    VALUES (null, :description, :comments, :type, :due_date, :target, :created, null, :company_id, null)";
    $prep = $con->prepare($additeamQuery);

    $prep->bindParam(':description', $description);
    $prep->bindParam(':comments', $comments);
    $prep->bindParam(':type', $type);
    $prep->bindParam(':due_date', $due_date);
    $prep->bindParam(':target', $target_value);
    $prep->bindParam(':created', $created);
    $prep->bindParam(':company_id', $companyId);


    $prep->execute();
    header("Location: /HrSystem/pages/goalItem.php");
}


/*
if (isset($_POST['addGoal'])) {
      
    $description=$_POST['description'];
    $comments=$_POST['comments'];
    $type=$_POST['type'];
    $due_date=$_POST['due_date'];
    $target_value=$_POST['target'];
    $completed=0;
    $created=date('y-m-d');

    $addgoalQuery="INSERT INTO `goals` (id, description, comments, type, due_date, target_value, value, user_id, completed, created, updated, notes) 
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
*/
if (isset($_POST['editCompanyGoal'])) {

    $value = !empty($_POST['value']) ? $_POST['value'] : null;
    $goal_id = $_POST['goal_id'];
    $value_id = $_POST['value_id'];
    $target_value = $_POST['target_value'];
    $comment = $_POST['comment'];
    $completed = isset($_POST['complete']) ? $_POST['complete'] : null;
    $done = 1;


    $userValueQuery = "SELECT * FROM companygoalsvalue WHERE value_id=:value_id";
    $prep = $con->prepare($userValueQuery);
    $prep->bindParam(':value_id', $value_id);
    $prep->execute();
    $userValue = $prep->fetch(PDO::FETCH_ASSOC);


    if ($userValue <= 0) {
        if ($value == $target_value || $value >= $target_value || $completed == 1) {

            $editgoalQuery = "INSERT INTO companygoalsvalue (value_id, user, company_goal, value, completed, comment, done)
        VALUES (null, :user, :company_goal, :value, :completed, :comment, :done)";

            $prep = $con->prepare($editgoalQuery);

            $prep->bindParam(':user', $userId);
            $prep->bindParam(':value', $value);
            $prep->bindParam(':company_goal', $goal_id);
            $prep->bindParam(':comment', $comment);
            $prep->bindParam(':completed', $completed);
            $prep->bindParam(':done', $done);

            $prep->execute();
            header("Location: /HrSystem/pages/goals.php");
        } else {

            $editgoalQuery = "INSERT INTO companygoalsvalue (value_id, user, company_goal, value, completed, comment, done)
        VALUES (null, :user, :company_goal, :value, :completed, :comment, null)";

            $prep = $con->prepare($editgoalQuery);

            $prep->bindParam(':user', $userId);
            $prep->bindParam(':value', $value);
            $prep->bindParam(':company_goal', $goal_id);
            $prep->bindParam(':comment', $comment);
            $prep->bindParam(':completed', $completed);

            $prep->execute();
            header("Location: /HrSystem/pages/goals.php");
        }
    } else {
        if ($value == $target_value || $value >= $target_value || $completed == 1) {

            $editgoalQuery = "UPDATE `companygoalsvalue` SET value=:value, completed=:completed, done=:done where value_id=:value_id";
            $prep = $con->prepare($editgoalQuery);

            $prep->bindParam(':value', $value);
            $prep->bindParam(':value_id', $value_id);
            $prep->bindParam(':completed', $completed);
            $prep->bindParam(':done', $done);

            $prep->execute();
            header("Location: /HrSystem/pages/goals.php");


        } else {
            $editgoalQuery = "UPDATE `companygoalsvalue` SET value=:value, completed=:completed where value_id=:value_id";
            $prep = $con->prepare($editgoalQuery);

            $prep->bindParam(':value', $value);
            $prep->bindParam(':value_id', $value_id);
            $prep->bindParam(':completed', $completed);

            $prep->execute();
            header("Location: /HrSystem/pages/goals.php");
        }
    }



}



$goalsQuery = "SELECT * FROM goals Right Join users on goals.user_id=users.user_id
WHERE goals.user_id=:user_id";
$prep = $con->prepare($goalsQuery);
$prep->bindParam(':user_id', $userId);
$prep->execute();
$goals = $prep->fetchAll();






$companyGoalsQ = "SELECT 
    c.id, c.name, c.description, c.type, c.due_date, c.created, 
    c.target_value, c.company_id, c.users,
    v.value, v.completed, v.comment, v.value_id
FROM companygoals c 
LEFT JOIN companygoalsvalue v 
    ON c.id = v.company_goal 
    AND v.user = :userId -- Ensure we only get the logged-in user's goal value
WHERE JSON_CONTAINS(c.users, :userIdJson) 
AND (v.done IS NULL OR v.done = 0) -- Exclude completed goals (boolean check)
ORDER BY c.id;
";
$prep = $con->prepare($companyGoalsQ);
$prep->bindParam(':userId', $userId, PDO::PARAM_STR);  // Normal user ID for goal values
$prep->bindParam(':userIdJson', $userIdJson, PDO::PARAM_STR);  // JSON user ID for companygoals.users check
$prep->execute();
$comapnygoals = $prep->fetchAll(PDO::FETCH_ASSOC);




?>