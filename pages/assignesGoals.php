<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];

$today = date('y-m-d');

$usergoalQ = "SELECT COUNT(*) FROM `goals` WHERE user_id = :user_id";
$prep = $con->prepare($usergoalQ);
$prep->bindParam(':user_id', $userId);
$prep->execute();
$userGoals = $prep->fetch();

$usergoalincQ = "SELECT COUNT(*) FROM `goals` WHERE compleated = 0";
$prep = $con->prepare($usergoalincQ);
$prep->execute();
$incompleteUserGoals = $prep->fetch();


$overdueQ = "SELECT COUNT(*) FROM `goals` WHERE due_date < :today";
$prep = $con->prepare($overdueQ);
$prep->bindParam(':today', $today);
$prep->execute();
$overdue = $prep->fetch();

$weekoverdueQ = "SELECT COUNT(*)
FROM goals
WHERE WEEK(due_date, 1) = WEEK(CURDATE(), 1)
AND YEAR(due_date) = YEAR(CURDATE())";
$prep = $con->prepare($weekoverdueQ);
$prep->execute();
$thisweekoverdue = $prep->fetch();


?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/assignedGoal.css">
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

<body style="background-color: #F4F6FA;">
    <div>
        <?php include '../template/sidebar.php' ?>
    </div>
    <div class="content">
        <?php include '../template/navbar.php' ?>
        <div class="companyName">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>
        <div id="goalsStats">
            <div class="stats">
                <div>
                    <h3><?= $userGoals['COUNT(*)'] ?></h3>
                    <p>Current Employee Goals</p>
                </div>
                <small><?= $incompleteUserGoals['COUNT(*)'] ?> Incomplete</small>
            </div>
            <div class="stats">
                <div>
                    <h3>0</h3>
                    <p>Company Goals</p>
                </div>
                <small>0 Goals Templates</small>
            </div>
            <div class="stats">
                <div>
                    <h3><?= $overdue['COUNT(*)'] ?></h3>
                    <p>Overdue Goals</p>
                </div>
                <small><?= $thisweekoverdue['COUNT(*)'] ?> Due This Week</small>
            </div>
        </div>
        <div id="goalsBody">
            <div id="goalsTableHead">
                <h5>Goal Items (Aggregate)</h5>
                <a data-bs-toggle="modal" data-bs-target="#assigneGoalModal"
                data-bs-whatever="@mdo">
                    <i class="fa fa-bullseye m-r-xs"></i>
                    Assign Goal To Employee(s)
                </a>
                <div class="modal fade-assigne-GoalModal" id="assigneGoalModal" tabindex="-1"
                            aria-labelledby="assigneGoalModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated slideInTop">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">×</button>
                                            <h4 class="modal-title" id="exampleModalLabel">Assigne Goal</h4>

                                        </div>

                                        <div class="modal-body">
                                            <div class="beginning-part">
                                                
                                            
                                            </div>

                                            

                                            <div class="last-part">
                                              
                                                
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-exit" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="editGoal" class="btn-save">Save</button>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
            </div>
            <div id="goalsTableBody">
                <div>
                    <span>First Goal</span>
                    <div>
                    <div>
                        <span>current goal value</span>
                        <span>10.0</span>
                    </div>
                    <span>></span>
                    </div>
                    <hr>

                </div>
            </div>

        </div>


        <?php include '../template/footer.php'; ?>
    </div>

</body>

</html>