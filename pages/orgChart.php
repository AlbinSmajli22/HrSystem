<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];

$itemsQuery = "SELECT * FROM goals
WHERE user_id=:user_id";
$prep = $con->prepare($itemsQuery);

$prep->bindParam(':user_id', $userId);
$prep->execute();
$goals = $prep->fetchAll();


$usersQuery = "SELECT users  FROM companygoals
WHERE id = 1";
$prep = $con->prepare($usersQuery);
$prep->execute();
$useres = $prep->fetch(PDO::FETCH_ASSOC);

$array = json_decode($useres['users'], true);

$albinarray=['44', '66', '77'];

$albinlength= count($albinarray);

for ($i=0; $i < $albinlength; $i++) { 

    array_push($array,$albinarray[$i]);
}



$jsonArray=json_encode($array);

print_r($array);

echo $jsonArray;




?>
<style>
.goal-progress {
    width: 100%;
    height: 20px;
    background-color: #f4f6fa; /* Grey background */
    border-radius: 5px;
    overflow: hidden;
}

.goal-bar {
    height: 100%;
    width: 0%; /* Default width */
    background-color: #4caf50; /* Default Green */
    transition: width 0.5s ease-in-out;
}



</style>

<?php foreach($goals as $goal ):

    $goalTarget = $goal['target_value']; // Example: The target percentage is 100%
    $currentValue = $goal['value']; // Example: Current progress is 50%
    
    $percentage = ($currentValue / $goalTarget) * 100;
    
?>
<div class="goal-progress">
    <div class="goal-bar" style="width: <?= $percentage ?>%; 
        background-color: <?= $percentage == 100 ? '#2196f3' : '#4caf50' ?>;">
    </div>
</div>
<p><?= $percentage ?>% Completed</p>
<?php endforeach; ?>
