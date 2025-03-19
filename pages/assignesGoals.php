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

$companyGoalsQ = "SELECT * FROM companygoals WHERE JSON_CONTAINS(users, :userId)";
$prep = $con->prepare($companyGoalsQ);
$prep->bindValue(':userId', json_encode((string) $userId), PDO::PARAM_STR);
$prep->execute();
$comapnygoals = $prep->fetchAll(PDO::FETCH_ASSOC);

$usergoalQ = "SELECT COUNT(*) FROM `goals`";
$prep = $con->prepare($usergoalQ);
$prep->execute();
$userGoals = $prep->fetch();

$usergoalincQ = "SELECT COUNT(*) FROM `goals` WHERE compleated = 0";
$prep = $con->prepare($usergoalincQ);
$prep->execute();
$incompleteUserGoals = $prep->fetch();


$overdueQ = "SELECT COUNT(*) FROM `companygoals` WHERE due_date < :today AND (completed IS NULL OR completed = 0)";
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
FROM companygoals
WHERE (completed IS NULL OR completed = 0)";
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
                    <h3><?= $ActiveCompGoalNumber['COUNT(*)']?></h3>
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
                            <div class="row">
                                <div class="col">
                                    <?php
                                    $GoalId = $comapnygoal['id'];

                                    // Fetch completed users along with their goal result (value)
                                    $compQuery = "SELECT u.name, u.surname, c.value, c.completed FROM `companygoalsvalue` c
                              INNER JOIN users u ON c.user = u.user_id
                              WHERE c.company_goal = :company_goal";
                                    $prep = $con->prepare($compQuery);
                                    $prep->bindParam(':company_goal', $GoalId);
                                    $prep->execute();
                                    $completedUsers = $prep->fetchAll(PDO::FETCH_ASSOC);

                                    // Count completed goals
                                    $compNum = count($completedUsers);
                                    ?>
                                    <img src="../images/check_on.png" width="24px" alt="">
                                    <span>Completed:</span>
                                    <span class="completedNr"><?= $compNum ?></span>
                                </div>
                                <div class="col">
                                    <img src="../images/check_off.png" width="24px" alt="">
                                    <span>Not Completed:</span>
                                    <?php
                                    $NotComparray = json_decode($comapnygoal['users'], true);
                                    if (!is_array($NotComparray)) {
                                        $NotComparray = [];
                                    }
                                    $notCompleted = count($NotComparray) - $compNum;
                                    ?>
                                    <span class="notCompletedNr"><?= max(0, $notCompleted) ?></span>
                                </div>
                            </div>
                            <div class="users_values" >
                                <?php foreach ($completedUsers as $user): ?>
                                    <p>
                                        <strong><?= htmlspecialchars($user['name']) ?>
                                            <?= htmlspecialchars($user['surname']) ?></strong>
                                        <?php if (isset($user['value']) && $user['value'] !== null): ?>
                                            <?= htmlspecialchars($user['value']) ?>
                                        <?php else: ?>
                                            <?php
                                            switch ($user['completed']) {
                                                case 0:
                                            ?>
                                                   Not Completed
                                            <?php
                                                    break;
                                                case 1:
                                            ?>
                                                   Completed
                                            <?php
                                                    break;
                                            }
                                            ?>
                                        <?php endif; ?>
                                    </p>
                                <?php endforeach; ?>
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
            const parent = this.closest('.cmpNotCmp'); // Find the closest parent
            const comments = parent.querySelector('.users_values'); // Find comments inside this parent


            // Toggle current comments visibility
            comments.style.display = comments.style.display === 'block' ? 'none' : 'block';
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