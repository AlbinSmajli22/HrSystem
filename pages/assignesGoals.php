<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];
$today = date('y-m-d');

$allCompanyGoals = "SELECT * FROM goalitems WHERE company_id = :company";
$prep = $con->prepare($allCompanyGoals);
$prep->bindParam(':company', $companyId);
$prep->execute();
$goalitems = $prep->fetchAll();

$usersQuery = "SELECT * FROM `users` WHERE company = :company";
$prep = $con->prepare($usersQuery);
$prep->bindParam(':company', $companyId);
$prep->execute();
$users = $prep->fetchAll();

$companyGoalsQ = "SELECT * FROM companygoals WHERE company_id=:company_id and user_goal is null";
$prep = $con->prepare($companyGoalsQ);
$prep->bindValue(':company_id', $companyId);
$prep->execute();
$comapnygoals = $prep->fetchAll(PDO::FETCH_ASSOC);
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


$usergoalQ = "SELECT COUNT(*) FROM `goals`";
$prep = $con->prepare($usergoalQ);
$prep->execute();
$userGoals = $prep->fetch();

$usergoalincQ = "SELECT COUNT(*) FROM `goals` WHERE completed = 0";
$prep = $con->prepare($usergoalincQ);
$prep->execute();
$incompleteUserGoals = $prep->fetch();


$overdueQ = "SELECT COUNT(*) FROM `companygoals` WHERE due_date < :today ";
$prep = $con->prepare($overdueQ);
$prep->bindParam(':today', $today);
$prep->execute();
$overdue = $prep->fetch();

$weekoverdueQ = "SELECT COUNT(*)
FROM companygoals
WHERE YEARWEEK(due_date, 1) = YEARWEEK(CURDATE(), 1)";
$prep = $con->prepare($weekoverdueQ);
$prep->execute();
$thisweekoverdue = $prep->fetch();


$ActiveCompGoal = "SELECT COUNT(*)
FROM companygoals";
$prep = $con->prepare($ActiveCompGoal);
$prep->execute();
$ActiveCompGoalNumber = $prep->fetch();


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
                    <h3><?= $ActiveCompGoalNumber['COUNT(*)'] ?></h3>
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
                <a data-bs-toggle="modal" data-bs-target="#assigneGoalModal" data-bs-whatever="@mdo">
                    <i class="fa fa-bullseye m-r-xs"></i>
                    Assign Goal To Employee(s)
                </a>
                <div class="modal fade-assigne-GoalModal" id="assigneGoalModal" tabindex="-1"
                    aria-labelledby="assigneGoalModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated slideInTop">
                            <form action="assignGoalLogic.php" method="post" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close">×</button>
                                    <h4 class="modal-title" id="exampleModalLabel">Assigne Goal</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="beginning-part">
                                        <div class="row">
                                            <div class="sub_row">
                                                <label for="selected_option">Assign To</label>
                                                <select name="selected_option" id="selectInput"
                                                    onchange="addItem(this)">
                                                    <option value="" disabled selected>Select</option>
                                                    <?php foreach ($users as $user): ?>
                                                        <option value="<?= $user['user_id'] ?>">
                                                            <?= htmlspecialchars($user['name']) ?>
                                                            <?= htmlspecialchars($user['surname']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="selected-items" id="selectedItems"></div>
                                            <!-- Hidden input to store selected values as JSON -->
                                            <input type="hidden" name="selected_values" id="selectedValues">
                                        </div>
                                        <div class="row">
                                            <label for="company_goals">Goal</label>
                                            <select name="company_goals" id="goalSelect">
                                                <option value="" disabled selected>Select an option</option>
                                                <?php foreach ($goalitems as $goalitem): ?>
                                                    <option value="<?= $goal['id'] ?>"
                                                        data-details="<?= htmlspecialchars($goalitem['details']) ?>"
                                                        data-date="<?= $goalitem['due_deadline'] ?>"
                                                        data-type="<?= $goalitem['type'] ?>"
                                                        data-target="<?= $goalitem['target'] ?>"
                                                        data-name="<?= $goalitem['name'] ?>">

                                                        <?= htmlspecialchars($goalitem['name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>


                                            <div id="goalDetails">
                                                <label for="details">Details:</label>
                                                <textarea id="details" rows="6" name="details" readonly></textarea>

                                                <label for="dueDate">Due Date:</label>
                                                <input type="text" id="dueDate" readonly name="dueDate">
                                                <input type="hidden" id="type" readonly name="type">
                                                <input type="hidden" id="target" readonly name="target">
                                                <input type="hidden" id="name" readonly name="name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="last-part">


                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn-exit" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="assignGoal" class="btn-save">Save</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="goalsTableBody">
                <?php foreach ($comapnygoals as $comapnygoal): ?>
                    <div class="comapanyGoals">
                        <div class="description">
                            <span><?= $comapnygoal['name'] ?></span>
                            <a class="more">
                                <i class="fa-solid fa-ellipsis"></i>
                            </a>
                            <br>
                            <div class="comments">
                                <p>
                                    <?= $comapnygoal['description'] ?>
                                </p>
                            </div>
                        </div>
                        <div class="cmpNotCmp">
                            <div class="pull-right">
                                <button class="showUseres"><i class="fa fa-caret-down"></i></button>
                            </div>
                            <?php if ($comapnygoal['type'] == 'Objective') { ?>
                                <div class="row">
                                    <div class="col">
                                        <?php
                                        $goalId = $comapnygoal['id'];
                                        $goalName = $comapnygoal['name'];


                                        $users = json_decode($comapnygoal['users'], true);
                                        $userCount = count($users);
                                        

                                        $values = $valuesByGoal[$goalId] ?? [];

                                        $totalCompleted = array_sum(array_column($values, 'completed'));
                                        ?>
                                        <img src="../images/check_on.png" width="24px" alt="">
                                        <span>Completed:</span>
                                        <span class="completedNr"><?= htmlspecialchars($totalCompleted) ?></span>
                                    </div>
                                    <div class="col">
                                        <img src="../images/check_off.png" width="24px" alt="">
                                        <span>Not Completed:</span>
                                        <span
                                            class="notCompletedNr"><?= htmlspecialchars($userCount - $totalCompleted) ?></span>
                                    </div>
                                </div>
                            <?php } elseif ($comapnygoal['type'] == 'Number' || $comapnygoal['type'] == 'Percentage' || $comapnygoal['type'] == 'Currency') { ?>
                                <div class="completedBar">
                                    <?php
                                    $goalId = $comapnygoal['id'];
                                    $goalName = $comapnygoal['name'];
                                    $targetPerUser = $comapnygoal['target_value'];

                                    $users = json_decode($comapnygoal['users'], true);
                                    $userCount = count($users);
                                    $totalTarget = $userCount * $targetPerUser;

                                    $values = $valuesByGoal[$goalId] ?? [];
                                    $totalCompleted = array_sum(array_column($values, 'value'));
                                    $percentComplete = $totalTarget > 0 ? round(($totalCompleted / $totalTarget) * 100) : 0;
                                    ?>
                                    <div class="goal-progress">
                                        <div class="goal-bar" style="width: <?= $percentComplete ?>%; 
                                        background-color: <?= $percentComplete == 100 ? '#2196f3' : '#2196f3' ?>;">
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="row">
                                    <div class="col">
                                        <?php
                                        $goalId = $comapnygoal['id'];
                                        $goalName = $comapnygoal['name'];
                                        $targetPerUser = $comapnygoal['target_value'];

                                        $users = json_decode($comapnygoal['users'], true);
                                        $userCount = count($users);
                                        $totalTarget = $userCount * $targetPerUser;



                                        $values = $valuesByGoal[$goalId] ?? [];

                                        $totalCompleted = array_sum(array_column($values, 'value'));
                                        ?>

                                        <span>Total Count:</span>
                                        <span class="completedNr"><?= htmlspecialchars($totalTarget) ?></span>
                                    </div>

                                </div>

                            <?php } ?>
                            <div class="users_values">
                                <?php if ($comapnygoal['type'] == 'Objective') { ?>
                                    <?php foreach ($values as $val):
                                        $userId = $val['user'];
                                        $userInfo = $userMap[$userId] ?? null;

                                        if ($userInfo) {
                                            $fullName = htmlspecialchars($userInfo['name'] . ' ' . $userInfo['surname']);
                                            $profileImage = htmlspecialchars($userInfo['image']); // Make sure to escape
                                        } else {
                                            $fullName = 'Unknown User';
                                            $profileImage = 'default.png'; // Or some fallback image
                                        } ?>
                                        <div class="userAndValue">
                                            <p>
                                                <img src="../userIMG/<?= $profileImage ?>" alt=""
                                                    style="width:25px; height:25px; border-radius:50%; vertical-align:middle; margin-right: 20px;">
                                                <strong><?= $fullName ?></strong>
                                            </p>
                                            <div class="compStatus">
                                                <img src="<?= $val['completed'] == 1 ? '../images/check_on.png' : '../images/check_off.png' ?>"
                                                    alt="" style="width:24px">
                                            </div>
                                            <?php
                                            $currentDate = date_create(gmdate('Y-m-d H:i:s')); // get full UTC time
                                            $createdDate = date_create($val['edited']); // must include time or default to 00:00:00
                                
                                            $createdFor = date_diff($createdDate, $currentDate);

                                            $years = (int) $createdFor->format('%y');
                                            $months = (int) $createdFor->format('%m');
                                            $days = (int) $createdFor->format('%a');
                                            $hours = (int) $createdFor->format('%h');
                                            $minutes = (int) $createdFor->format('%i');
                                            $seconds = (int) $createdFor->format('%s');

                                            if ($years > 0) {
                                                echo '<small>edited ' . $years . ($years === 1 ? ' year ago' : ' years ago') . '</small>';
                                            } elseif ($months > 0) {
                                                echo '<small>edited ' . $months . ($months === 1 ? ' month ago' : ' months ago') . '</small>';
                                            } elseif ($days > 0) {
                                                echo '<small>edited ' . $days . ($days === 1 ? ' day ago' : ' days ago') . '</small>';
                                            } elseif ($hours > 0) {
                                                echo '<small>edited ' . $hours . ($hours === 1 ? ' hour ago' : ' hours ago') . '</small>';
                                            } elseif ($minutes > 0) {
                                                echo '<small>edited ' . $minutes . ($minutes === 1 ? ' minute ago' : ' minutes ago') . '</small>';
                                            } else {
                                                echo '<small>edited ' . $seconds . ($seconds === 1 ? ' second ago' : ' seconds ago') . '</small>';
                                            }


                                            ?>
                                        </div>

                                    <?php endforeach; ?>
                                <?php } elseif ($comapnygoal['type'] == 'Counter') { ?>
                                    <?php foreach ($values as $val):
                                        $userId = $val['user'];
                                        $userInfo = $userMap[$userId] ?? null;

                                        if ($userInfo) {
                                            $fullName = htmlspecialchars($userInfo['name'] . ' ' . $userInfo['surname']);
                                            $profileImage = htmlspecialchars($userInfo['image']); // Make sure to escape
                                        } else {
                                            $fullName = 'Unknown User';
                                            $profileImage = 'default.png'; // Or some fallback image
                                        } ?>
                                        <div class="userAndValue">
                                            <p>
                                                <img src="../userIMG/<?= $profileImage ?>" alt=""
                                                    style="width:25px; height:25px; border-radius:50%; vertical-align:middle; margin-right: 20px;">
                                                <strong><?= $fullName ?></strong>
                                            </p>
                                            <div class="compStatus">
                                                <span class="completedNr"
                                                    style=" background-color:<?= $val['value'] == $targetPerUser ? '#2196f3' : '#d1dade' ?>; color:<?= $val['value'] == $targetPerUser ? '#ffffff' : '#5e5e5e' ?>;"><?= htmlspecialchars($val['value']) ?></span>
                                            </div>
                                            <?php
                                            $currentDate = date_create(gmdate('Y-m-d H:i:s')); // get full UTC time
                                            $createdDate = date_create($val['edited']); // must include time or default to 00:00:00
                                
                                            $createdFor = date_diff($createdDate, $currentDate);

                                            $years = (int) $createdFor->format('%y');
                                            $months = (int) $createdFor->format('%m');
                                            $days = (int) $createdFor->format('%a');
                                            $hours = (int) $createdFor->format('%h');
                                            $minutes = (int) $createdFor->format('%i');
                                            $seconds = (int) $createdFor->format('%s');

                                            if ($years > 0) {
                                                echo '<small>edited ' . $years . ($years === 1 ? ' year ago' : ' years ago') . '</small>';
                                            } elseif ($months > 0) {
                                                echo '<small>edited ' . $months . ($months === 1 ? ' month ago' : ' months ago') . '</small>';
                                            } elseif ($days > 0) {
                                                echo '<small>edited ' . $days . ($days === 1 ? ' day ago' : ' days ago') . '</small>';
                                            } elseif ($hours > 0) {
                                                echo '<small>edited ' . $hours . ($hours === 1 ? ' hour ago' : ' hours ago') . '</small>';
                                            } elseif ($minutes > 0) {
                                                echo '<small>edited ' . $minutes . ($minutes === 1 ? ' minute ago' : ' minutes ago') . '</small>';
                                            } else {
                                                echo '<small>edited ' . $seconds . ($seconds === 1 ? ' second ago' : ' seconds ago') . '</small>';
                                            }

                                            ?>
                                        </div>

                                    <?php endforeach; ?>


                                <?php } else { ?>
                                    <?php foreach ($values as $val):
                                        $userId = $val['user'];
                                        $userInfo = $userMap[$userId] ?? null;

                                        if ($userInfo) {
                                            $fullName = htmlspecialchars($userInfo['name'] . ' ' . $userInfo['surname']);
                                            $profileImage = htmlspecialchars($userInfo['image']); // Make sure to escape
                                        } else {
                                            $fullName = 'Unknown User';
                                            $profileImage = 'default.png'; // Or some fallback image
                                        }
                                        $userPercentage = ($targetPerUser > 0) ? ($val['value'] / $targetPerUser) * 100 : 0;
                                        ?>
                                        <div class="userAndValue">
                                            <p>
                                                <img src="../userIMG/<?= $profileImage ?>" alt=""
                                                    style="width:25px; height:25px; border-radius:50%; vertical-align:middle; margin-right: 20px;">
                                                <strong><?= $fullName ?></strong>
                                            </p>
                                            <div class="empty_space">
                                                <div class="goal-bar"
                                                    style="width: <?= $userPercentage ?>%; 
                                                 background-color: <?= $userPercentage == 100 ? '#2196f3' : '#4caf50' ?>;">
                                                    &nbsp;
                                                </div>
                                            </div>
                                            <?php
                                            $currentDate = date_create(gmdate('Y-m-d H:i:s')); // get full UTC time
                                            $createdDate = date_create($val['edited']); // must include time or default to 00:00:00
                                
                                            $createdFor = date_diff($createdDate, $currentDate);

                                            $years = (int) $createdFor->format('%y');
                                            $months = (int) $createdFor->format('%m');
                                            $days = (int) $createdFor->format('%a');
                                            $hours = (int) $createdFor->format('%h');
                                            $minutes = (int) $createdFor->format('%i');
                                            $seconds = (int) $createdFor->format('%s');

                                            if ($years > 0) {
                                                echo '<small>edited ' . $years . ($years === 1 ? ' year ago' : ' years ago') . '</small>';
                                            } elseif ($months > 0) {
                                                echo '<small>edited ' . $months . ($months === 1 ? ' month ago' : ' months ago') . '</small>';
                                            } elseif ($days > 0) {
                                                echo '<small>edited ' . $days . ($days === 1 ? ' day ago' : ' days ago') . '</small>';
                                            } elseif ($hours > 0) {
                                                echo '<small>edited ' . $hours . ($hours === 1 ? ' hour ago' : ' hours ago') . '</small>';
                                            } elseif ($minutes > 0) {
                                                echo '<small>edited ' . $minutes . ($minutes === 1 ? ' minute ago' : ' minutes ago') . '</small>';
                                            } else {
                                                echo '<small>edited ' . $seconds . ($seconds === 1 ? ' second ago' : ' seconds ago') . '</small>';
                                            }

                                            ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php } ?>
                            </div>

                        </div>

                    </div>
                <?php endforeach ?>
            </div>
        </div>


        <?php include '../template/footer.php'; ?>
    </div>

</body>
<script>

    document.querySelectorAll('.more').forEach(more => {
        more.addEventListener('click', function () {
            const parent = this.closest('.comapanyGoals'); // Find the closest parent
            const comments = parent.querySelector('.comments'); // Find comments inside this parent

            /* Hide all other comments
            document.querySelectorAll('.comments').forEach(c => {
                if (c !== comments) c.style.display = 'none';
            });*/

            // Toggle current comments visibility
            comments.style.display = comments.style.display === 'block' ? 'none' : 'block';
        });
    });
    document.querySelectorAll('.showUseres').forEach(more => {
        more.addEventListener('click', function () {
            const parent = this.closest('.cmpNotCmp');
            const comments = parent.querySelector('.users_values');

            // Use getComputedStyle to check current display
            const isVisible = window.getComputedStyle(comments).display !== 'none';

            // Toggle display
            comments.style.display = isVisible ? 'none' : 'flex';
        });
    });



    let selectedValuesArray = [];
    let select = document.getElementById("selectInput");
    let selectedItemsContainer = document.getElementById("selectedItems");
    let hiddenInput = document.getElementById("selectedValues");


    function addItem(selectElement) {
        if (selectElement.value) {
            let selectedOption = selectElement.options[selectElement.selectedIndex];
            let text = selectedOption.text;
            let value = selectedOption.value;

            addSelectedItem(text, value);
            selectedValuesArray.push(value);
            updateArrayOutput();

            selectElement.remove(selectElement.selectedIndex); // Remove from dropdown
            selectElement.selectedIndex = 0;
        }
    }

    function addSelectedItem(text, value) {
        let item = document.createElement("div");
        item.classList.add("item");
        item.innerHTML = `${text} <span class="remove-btn" onclick="removeItem(this, '${text}', '${value}')">✖</span>`;
        selectedItemsContainer.appendChild(item);
    }

    function removeItem(element, text, value) {
        element.parentElement.remove();
        selectedValuesArray = selectedValuesArray.filter(item => item !== value);
        updateArrayOutput();

        // Restore option back to select
        let option = document.createElement("option");
        option.value = value;
        option.textContent = text;
        select.appendChild(option);
    }

    function updateArrayOutput() {

        hiddenInput.value = JSON.stringify(selectedValuesArray); // Store in hidden input for PHP
    }


    document.getElementById("goalSelect").addEventListener("change", function () {
        let selectedOption = this.options[this.selectedIndex];

        if (selectedOption.value) {
            document.getElementById("details").value = selectedOption.getAttribute("data-details");
            document.getElementById("dueDate").value = selectedOption.getAttribute("data-date");
            document.getElementById("type").value = selectedOption.getAttribute("data-type");
            document.getElementById("target").value = selectedOption.getAttribute("data-target");
            document.getElementById("name").value = selectedOption.getAttribute("data-name");
            document.getElementById("goalDetails").style.display = "flex"; // Show details
        } else {
            document.getElementById("goalDetails").style.display = "none"; // Hide details
        }
    });
</script>

</html>