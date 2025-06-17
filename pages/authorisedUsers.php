<?php
require_once '../config.php';
session_start();

include 'addExpensseLogic.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/authorisedUsers.css">
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
                    Authorised Users
                </h5>
                <button id="addExpenseCategory" data-bs-toggle="modal" data-bs-target="#addExpensesModal"
                    data-bs-whatever="@mdo">
                    <a>
                        <i class="fa fa-plus"></i>
                        Add A New User
                    </a>
                </button>
            </div>
            <div class="expensesTableBody">
                <table class="recentExpenses">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Last Logon</th>
                            <th>Active</th>
                            <th>Company Owner</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($expenses as $expense): ?>
                            <tr>
                                <td>
                                    <?= $expense['claim_date'] ?>
                                </td>
                                <td>
                                    <p> <?= $expense['description'] ?></p><br>
                                    <small><?= $expense['comments'] ?></small>
                                </td>
                                <td>
                                    <?= $expense['currency'] ?>
                                    <?= $expense['amount'] ?>
                                </td>
                                <td>
                                    <?= $expense['currency'] ?>
                                    <?= $expense['tax'] ?>
                                </td>
                                <td>
                                    <?= $expense['status'] ?>
                                </td>
                                <td>
                                    <button class=" btn btn-xs btn-circle btn-outline btn-info m-l-sm"
                                        data-bs-toggle="modal" data-bs-target="#expenseEditModal<?= $expense['id'] ?>"
                                        data-bs-whatever="@mdo"> <i class=" fa fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div>
                </div>
            </div>
        </div>
        <?php include '../template/footer.php'; ?>
    </div>
</body>
</html>