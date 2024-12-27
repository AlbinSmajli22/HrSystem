<?php
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];
$Submited="Submited";

$errors = array('file_size' => '', 'file_exist' => '', 'file_format' => '' );


if (isset($_POST['addGoal'])) {
    
   
    

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