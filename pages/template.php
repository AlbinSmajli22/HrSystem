<?php
require_once '../config.php';
session_start();
include 'addNewGoal.php';
/*

$sql = "SELECT * from companygoals where company_id=1";

$prep = $con->prepare($sql);
$prep->execute();
$goals = $prep->fetchAll();


$employee =json_decode($goals[0]['users']);
echo'goal for urers';
print_r($employee);*/
?>

<?php
// Replace this with the actual logged-in user's ID
$loggedInUserId = 17; // Example: the logged-in user's ID

// SQL query to fetch rows where the user ID is in the `users` column
$sql = "SELECT * FROM companygoals WHERE JSON_CONTAINS(users, :userId)";
$stmt = $con->prepare($sql);

// Bind the logged-in user's ID as a JSON-formatted string
$stmt->bindValue(':userId', json_encode((string)$loggedInUserId), PDO::PARAM_STR);

try {
    $stmt->execute();
    $goals = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($goals) {
        foreach ($goals as $goal) {
            echo "Goal ID: " . $goal['id'] . "<br>";
            echo "Description: " . $goal['description'] . "<br>";
            echo "Comments: " . $goal['comments'] . "<br>";
            echo "Type: " . $goal['type'] . "<br>";
            echo "Due Date: " . $goal['due_date'] . "<br><br>";
        }
    } else {
        echo "No goals found for the logged-in user.";
    }
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>

