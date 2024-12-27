<?php
require_once '../config.php';
session_start();

include 'addNewGoal.php';

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/expenses.css">
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
                <button id="addExpenseCategory" data-bs-toggle="modal" data-bs-target="#addExpensesModal"
                    data-bs-whatever="@mdo">
                    <a>
                        <i class="fa fa-plus"></i>
                        Add Expense
                    </a>
                </button>
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
            </div>
            <div class="expensesTableBody">



                <?php foreach ($goals as $goal): ?>
                    <div>
                        <h5>
                            <?= $goal['description'] ?>
                        </h5>
                        <small>Last Updated:   Due on: <?= $goal['due_date'] ?></small>
                    </div>


                <?php endforeach; ?>



                <div>

                </div>
            </div>
        </div>
        <?php include '../template/footer.php'; ?>
    </div>

</body>

</html>