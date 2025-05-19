<?php
require_once '../config.php';
session_start();
include 'addNewGoal.php';

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/addgoalItem.css">
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

<body>
    <div>
        <?php include '../template/sidebar.php' ?>
    </div>
    <div class="content">
        <?php include '../template/navbar.php' ?>
        <div class="newGoalHead">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>

        <div class="newGoalBody">
            <div class="GoalHead">
                <h4>
                    <i class="fa-solid fa-bullseye"></i>
                    Goal Details
                </h4>
            </div>
            <div class="GoalBody">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="description">Description</label><br>
                        <input type="text" name="description">
                        <p>Short description (heading) of this goal</p>
                    </div>
                    <div class="form-group">
                        <label for="comments">Comments</label><br>
                        <textarea name="comments" id="comments" rows="3"></textarea>
                        <p>Enter any additional comments or explanation about this goal</p>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label><br>
                        <select name="type" id="type" onchange="toggleTargetValueField()">
                            <option value="Number">Number</option>
                            <option value="Currency">Currency</option>
                            <option value="Counter">Counter</option>
                            <option value="Percentage">Percentage</option>
                            <option value="Objective">Objective</option>
                        </select>
                        <p>This defines the way that progress against this goal is measured</p>
                    </div>
                    <div id="goal_types_ex">
                        <div id="goal_types">
                            <p>Explanation of goal types above:</p>
                            <ul>
                                <li> <strong>Number -</strong> You can enter a (round) number to track progress against
                                    a goal. <em>(e.g. The number of orders you have processed this month)</em></li>
                                <li><strong>Currency -</strong> You can enter in a currency value to track progress
                                    against. <em>(e.g. Progress towards a sales target)</em></li>
                                <li><strong>Counter -</strong> A stepped counter that can increment/decrement to track
                                    how many times something is achieved. <em>(e.g. Number of times you have caught
                                        public transport to work)</em> </li>
                                <li><strong>Percentage -</strong> A simple progress bar from 0 to 100%. <em>(e.g. How
                                        much of a course you have completed)</em></li>
                                <li><strong>Objective -</strong> A simple checkbox that denotes if you have achieved a
                                    goal or not. <em>(e.g. To mark completion of a particular project or meeting)</em>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Due Date</label><br>
                        <input type="date" name="due_date" id="due_date">
                        <p>Please enter the date that the goal is due, or leave blank for a perpetual goal (no expiry
                            date)</p>
                    </div>
                    <hr>
                    <div class="form-group" id="targetValueContainer">
                        <label for="target">Target Value</label><br>
                        <input type="number" name="target" id="target">
                        <p>Default target value to set for this goal (can be adjusted later)</p>
                    </div>
                    <div class="ArticleFooter">
                        <button type="submit" name="addGoalItem">Create Goal</button>
                        <a href="goalItem.php" class="cancel">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <?php include '../template/footer.php'; ?>
    </div>
    <script>
        function toggleTargetValueField() {
            const goalType = document.getElementById("type").value;
            const targetValueContainer = document.getElementById("targetValueContainer");

            // Hide target value if percentage or objective is selected
            if (goalType === "Percentage" || goalType === "Objective") {
                targetValueContainer.style.display = "none";
            } else {
                targetValueContainer.style.display = "block";
            }
        }

        // Run the function once at the start to set initial state
        toggleTargetValueField();
    </script>
</body>