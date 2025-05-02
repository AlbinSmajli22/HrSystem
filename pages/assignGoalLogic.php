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

    $usersQuery = "SELECT *  FROM companygoals
    WHERE name LIKE  :name ";
    $prep = $con->prepare($usersQuery);
    $prep->bindParam(':name', $name);
    $prep->execute();
    $fetchedusers = $prep->fetch(PDO::FETCH_ASSOC);
    
    if($fetchedusers <= 0 ){ 

        $asignGoalQuery="INSERT INTO companygoals (id, name, description, type, due_date, created, target_value, company_id, users)
                                         VALUES (null, :name, :description, :type, :due_date, :created, :target_value, :company_id, :users)";
        
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
    else{

        $usersArray = json_decode($fetchedusers['users'], true);

        $newUsersArray= json_decode($users, true);

        $newUsersLength= count($newUsersArray);

        for ($i=0; $i <$newUsersLength ; $i++) { 
            
            array_push($usersArray,  $newUsersArray[$i]);
        }

        $jsonUsersArray=json_encode( $usersArray);

        $updateGoalQuery="UPDATE `companygoals` SET users=:users WHERE name LIKE  :name ";
        
        $prep = $con->prepare($updateGoalQuery);
        $prep->bindParam(':name', $name);
        $prep->bindParam(':users',  $jsonUsersArray);
    
        $prep->execute();
        
        header("Location: /HrSystem/pages/assignesGoals.php");

    }
    }

    

?>
