<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];

// 1. Fetch company goals
$companyGoalsQ = "SELECT * FROM `companygoals` WHERE company_id = :companyId";
$prep = $con->prepare($companyGoalsQ);
$prep->bindParam(':companyId', $companyId);
$prep->execute();
$companyGoals = $prep->fetchAll(PDO::FETCH_ASSOC);

// 2. Fetch all goal values once
$allValuesQ = "SELECT * FROM `companygoalsvalue`";
$prep = $con->prepare($allValuesQ);
$prep->execute();
$allGoalValues = $prep->fetchAll(PDO::FETCH_ASSOC);

// 3. Fetch all users once
$usersQ = "SELECT user_id, name FROM users";
$prep = $con->prepare($usersQ);
$prep->execute();
$allUsers = $prep->fetchAll(PDO::FETCH_ASSOC);
$userMap = [];
foreach ($allUsers as $user) {
    $userMap[$user['user_id']] = $user['name'];
}

// 4. Group values by goal ID
$valuesByGoal = [];
foreach ($allGoalValues as $val) {
    $valuesByGoal[$val['company_goal']][] = $val;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Company Goals</title>
    <style>
        .goal-progress {
            width: 100%;
            background: #ddd;
            border-radius: 6px;
            margin-bottom: 10px;
            height: 24px;
        }

        .goal-bar {
            height: 100%;
            border-radius: 6px;
            transition: width 0.5s ease;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .goal-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            background-color: #f9f9f9;
        }

        h2 {
            margin-top: 0;
        }

        p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <h1>Company Goals Overview</h1>

    <?php foreach ($companyGoals as $goal): 
        $goalId = $goal['id'];
        $goalName = $goal['name'];
        $targetPerUser = $goal['target_value'];
        
        $users = json_decode($goal['users'], true);
        $userCount = count($users);
        $totalTarget = $userCount * $targetPerUser;

        $values = $valuesByGoal[$goalId] ?? [];
        $totalCompleted = array_sum(array_column($values, 'value'));
        $percentComplete = $totalTarget > 0 ? round(($totalCompleted / $totalTarget) * 100) : 0;
    ?>

    <div class="goal-card">
        <h2><?= htmlspecialchars($goalName) ?></h2>
        <p><strong><?= $percentComplete ?>%</strong> completed</p>

        <div class="goal-progress">
            <div class="goal-bar" style="width: <?= $percentComplete ?>%; 
                background-color: <?= $percentComplete == 100 ? '#2196f3' : '#4caf50' ?>;">
            </div>
        </div>

        <?php foreach ($values as $val): 
            $userId = $val['user'];
            $userName = $userMap[$userId] ?? 'Unknown User';
        ?>
            <p><?= htmlspecialchars($userName) ?>: <?= $val['value'] ?> out of <?= $targetPerUser ?></p>
        <?php endforeach; ?>
    </div>

    <?php endforeach; ?>

</body>
</html>
