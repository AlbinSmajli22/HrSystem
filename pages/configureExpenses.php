<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];


$exceptionsQuery = "SELECT * FROM expensescategory
WHERE company_id=:company_id";
$prep = $con->prepare($exceptionsQuery);
$prep->bindParam(':company_id', $companyId);
$prep->execute();
$expenses = $prep->fetchAll();



if (isset($_POST['addExpense'])) {

    $name = $_POST['name'];

    $addExpensesQuery = "INSERT INTO  expensescategory  (name, company_id) VALUES (:name, :company_id )";

    $prep = $con->prepare($addExpensesQuery);
    $prep->bindParam(':name', $name);
    $prep->bindParam(':company_id', $companyId);

    $prep->execute();
    header("Location: /HrSystem/pages/configureExpenses.php");
}
if (isset($_POST['editExpense'])) {

    $id = $_POST['new_id'];
    $company_id = $_POST['company_id'];
    $name = $_POST['name'];

    $editExpensesQuery = "UPDATE expensescategory SET name=:name,  company_id=:company_id WHERE expensescategory.id =:id ";

    $prep = $con->prepare($editExpensesQuery);
    $prep->bindParam(':id', $id);
    $prep->bindParam(':name', $name);
    $prep->bindParam(':company_id', $company_id);

    $prep->execute();
    header("Location: /HrSystem/pages/configureExpenses.php");
}

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
                        Add Expense Category
                    </a>
                </button>
                <div class="modal fade-addExpensesModal" id="addExpensesModal" tabindex="-1"
                    aria-labelledby="addExpensesModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" method="post">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Exception</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <label for="name">Expense Category Name</label>
                                    <input type="text" name="name" id="name">
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" name="addExpense" class="btn btn-success">Edit</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="expensesTableBody">
                <table class="recentExpenses">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($expenses as $expense): ?>
                            <tr>
                                <td>
                                    <?= $exception['name'] ?>
                                </td>
                                <td>
                                    <button class=" btn btn-xs btn-circle btn-outline btn-info m-l-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#exceptionEditModal<?php echo $exception['id']; ?>"
                                        data-bs-whatever="@mdo"> <i class=" fa fa-edit"></i> </button>
                                    <a href="deleteExpenseCategory.php?expense_id=<?= $exception['id']; ?>"
                                        class="btn btn-xs btn-circle btn-outline btn-danger m-l-sm"> <i
                                            class="fa fa-trash"></i> </a>
                                </td>
                                <div class="modal fade-exceptionEditModal"
                                    id="exceptionEditModal<?php echo $exception['id']; ?>" tabindex="-1"
                                    aria-labelledby="exceptionEditModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="" method="post">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Exception</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <input type="hidden" name="new_id" id="new_id"
                                                        value="<?= $exception['id'] ?>">
                                                    <input type="hidden" name="company_id" id="company_id"
                                                        value="<?= $_SESSION['company'] ?>">
                                                    <label for="name">Category Name</label>
                                                    <input type="text" name="name" id="name"
                                                        value="<?= $exception['name'] ?>">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="editExpense"
                                                        class="btn btn-success">Edit</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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