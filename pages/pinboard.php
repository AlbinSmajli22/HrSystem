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
$usersQ = "SELECT user_id, image , name, surname FROM users";
$prep = $con->prepare($usersQ);
$prep->execute();
$allUsers = $prep->fetchAll(PDO::FETCH_ASSOC);
$userMap = [];
foreach ($allUsers as $user) {
    $userMap[$user['user_id']] = [
        'image' => $user['image'],
        'name' => $user['name'],
        'surname' => $user['surname']

    ];
}


// 4. Group values by goal ID
$valuesByGoal = [];
foreach ($allGoalValues as $val) {
    $valuesByGoal[$val['company_goal']][] = $val;
}
$completedByGoal = [];
foreach ($allGoalValues as $val) {
    $completedByGoal[$val['company_goal']][] = $val;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pinboard.css">
    <script src="https://kit.fontawesome.com/3d560ffcbd.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
        crossorigin="anonymous"></script>
</head>

<body style="background-color: #F4F6FA; ">
    <div>
        <?php include '../template/sidebar.php' ?>
    </div>
    <div class="content">
        <?php include '../template/navbar.php' ?>
        <div class="pinBoardHead">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>

        <div class="pinBoardBody">
            <div class="intro">
                <div class="pull-right">
                    <button type="button"><i class="fa fa-thumb-tack"></i> Add A New Pin</button>
                </div>
                <p>
                    The Pinboard is the area where you can 'pin' short public messages to all other employees. Whether
                    it is a classified ad, or a 'well done' message to a co-worker, or anything else!
                </p>
                <p>
                    Note: Pins will be displayed for a maximum of <strong>30</strong> days.
                </p>


            </div>
            <div class="pinBoard">



            </div>
        </div>
        <?php include '../template/footer.php'; ?>
    </div>

</body>

</html>