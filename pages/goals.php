<?php
require_once '../config.php';
session_start();

include 'addNewGoal.php';

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/goals.css">
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
        <div class="expensesHead">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>

        <div class="expensesBody">
            <div class="expensesTableHead">
                <h5>
                    Expenses
                </h5>
                <button id="addExpenseCategory">
                    <a href="addGoal.php">
                        <i class="fa fa-plus"></i>
                        Add Goal
                    </a>
                </button>

            </div>
            <div class="expensesTableBody">



                <?php foreach ($goals as $goal): ?>
                    <div id="theGoal">
                        <div id="Goal2">
                            <div id="description">
                                <div id="description2">
                                    <h5>
                                        <?= $goal['description'] ?>
                                    </h5>
                                    <i class="fa-solid fa-ellipsis"></i>
                                </div>

                                <?php
                                $currentDate = gmdate('Y-m-d');
                                $currentDate = date_create($currentDate);
                                $dueDate = $goal['due_date'];
                                $dueDate = date_create($dueDate);
                                $updateDate = $goal['updated'];
                                $updateDate = date_create($updateDate);

                                $dueDateOn = date_diff($dueDate, $currentDate);
                                $updatedOn = date_diff($updateDate, $currentDate);
                                ?>
                                <small>Last Updated: <?= $updatedOn->d ?> days ago Due on: <strong>
                                        <?= $goal['due_date'] ?></strong> (in <?= $dueDateOn->d ?> days)</small>
                            </div>
                            <i class="fa-solid fa-ellipsis-vertical" id="editbtn"></i>
                            <div class="edit-dropdown-content">
                                <a href="">edit</a>
                                <a href="">delete</a>
                            </div>
                        </div>
                        <div class="modal fade-addExpensesModal" id="addExpensesModal" tabindex="-1"
                            aria-labelledby="addExpensesModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Claim</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="addGoal" class="btn btn-success">Submit
                                                Claim</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="Comments">
                            <?= $goal['comments'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php include '../template/footer.php'; ?>
    </div>
    <Script>
        function myFunctionFour() {
            document.getElementById("goalsConfigure").classList.toggle("showEdit");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches('#editbtn')) {
                var dropdowns = document.getElementsByClassName("edit-dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('showEdit')) {
                        openDropdown.classList.remove('showEdit');
                    }
                }
            }
        }
    </Script>
</body>

</html>