<?php
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];
$admin = $_SESSION['role'];
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



if (isset($_POST['addGoal'])) {
      
    $description=$_POST['description'];
    $comments=$_POST['comments'];
    $type=$_POST['type'];
    $due_date=$_POST['due_date'];
    $target_value=$_POST['target'];
    $completed=0;
    $created=date('y-m-d');
    $user_goal=1;
    

    $addgoalQuery="INSERT INTO companygoals (id, name, description, type, due_date, created, target_value, company_id, users, user_goal)
                                     VALUES (null, :name, :description, :type, :due_date, :created, :target_value, :company_id, :users, :user_goal)";
    $prep=$con->prepare($addgoalQuery);
   
    $prep->bindParam(':name', $description);
    $prep->bindParam(':description', $comments);
    $prep->bindParam(':type', $type);
    $prep->bindParam(':due_date', $due_date);
    $prep->bindParam(':target_value', $target_value);
    $prep->bindParam(':created', $created);
    $prep->bindParam(':users', $userIdJson);
     $prep->bindParam(':user_goal', $user_goal);
      $prep->bindParam(':company_id', $companyId);

    $prep->execute();
    header("Location: /HrSystem/pages/goals.php");
}
/*

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
    $edited=date('y-m-d h:i:s');


    $userValueQuery = "SELECT * FROM companygoalsvalue WHERE value_id=:value_id";
    $prep = $con->prepare($userValueQuery);
    $prep->bindParam(':value_id', $value_id);
    $prep->execute();
    $userValue = $prep->fetch(PDO::FETCH_ASSOC);


    if ($userValue <= 0) {
        if ($value == $target_value || $value >= $target_value || $completed == 1) {

            $editgoalQuery = "INSERT INTO companygoalsvalue (value_id, user, company_goal, value, completed, comment, done, edited)
        VALUES (null, :user, :company_goal, :value, :completed, :comment, :done, :edited)";

            $prep = $con->prepare($editgoalQuery);

            $prep->bindParam(':user', $userId);
            $prep->bindParam(':value', $value);
            $prep->bindParam(':company_goal', $goal_id);
            $prep->bindParam(':comment', $comment);
            $prep->bindParam(':completed', $completed);
            $prep->bindParam(':done', $done);
            $prep->bindParam(':edited', $edited);

            $prep->execute();
            header("Location: /HrSystem/pages/goals.php");
        } else {

            $editgoalQuery = "INSERT INTO companygoalsvalue (value_id, user, company_goal, value, completed, comment, done, edited)
        VALUES (null, :user, :company_goal, :value, :completed, :comment, null, :edited)";

            $prep = $con->prepare($editgoalQuery);

            $prep->bindParam(':user', $userId);
            $prep->bindParam(':value', $value);
            $prep->bindParam(':company_goal', $goal_id);
            $prep->bindParam(':comment', $comment);
            $prep->bindParam(':completed', $completed);
            $prep->bindParam(':edited', $edited);

            $prep->execute();
            header("Location: /HrSystem/pages/goals.php");
        }
    } else {
        if ($value == $target_value || $value >= $target_value || $completed == 1) {

            $editgoalQuery = "UPDATE `companygoalsvalue` SET value=:value, completed=:completed, done=:done, edited=:edited where value_id=:value_id";
            $prep = $con->prepare($editgoalQuery);

            $prep->bindParam(':value', $value);
            $prep->bindParam(':value_id', $value_id);
            $prep->bindParam(':completed', $completed);
            $prep->bindParam(':done', $done);
            $prep->bindParam(':edited', $edited);

            $prep->execute();
            header("Location: /HrSystem/pages/goals.php");


        } else {
            $editgoalQuery = "UPDATE `companygoalsvalue` SET value=:value, completed=:completed, edited=:edited where value_id=:value_id";
            $prep = $con->prepare($editgoalQuery);

            $prep->bindParam(':value', $value);
            $prep->bindParam(':value_id', $value_id);
            $prep->bindParam(':completed', $completed);
            $prep->bindParam(':edited', $edited);

            $prep->execute();
            header("Location: /HrSystem/pages/goals.php");
        }
    }



}









$companyGoalsQ = "SELECT 
    c.id, c.name, c.description, c.type, c.due_date, c.created, 
    c.target_value, c.company_id, c.users,c.user_goal,
    v.value, v.completed, v.comment, v.value_id, v.done
FROM companygoals c 
LEFT JOIN companygoalsvalue v 
    ON c.id = v.company_goal 
    AND v.user = :userId -- Ensure we only get the logged-in user's goal value
WHERE JSON_CONTAINS(c.users, :userIdJson) 
 -- Exclude completed goals (boolean check)
ORDER BY c.id DESC;
";


$prep = $con->prepare($companyGoalsQ);
$prep->bindParam(':userId', $userId, PDO::PARAM_STR);  // Normal user ID for goal values
$prep->bindParam(':userIdJson', $userIdJson, PDO::PARAM_STR);  // JSON user ID for companygoals.users check
$prep->execute();
$comapnygoals = $prep->fetchAll(PDO::FETCH_ASSOC);




?>