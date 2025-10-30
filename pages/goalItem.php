<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];

$itemsQuery = "SELECT * FROM goalitems
WHERE company_id=:company_id";
$prep = $con->prepare($itemsQuery);
$prep->bindParam(':company_id', $companyId);
$prep->execute();
$goalitems = $prep->fetchAll();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/goalItems.css">
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
        <?php include '../template/adminSidebar.php' ?>
    </div>
    <div class="content">
        <?php include '../template/navbar.php' ?>
        <div class="goalItemHead">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>

        <div class="goalItemsBody">
            <div class="goalItemsTableHead">
                <h5>
                    <i class="fa fa-list m-r-sm"></i>
                    Goal Items
                </h5>
                <button id="addExpenseCategory">
                    <a href="addgoalItem.php">
                        <i class="fa fa-plus"></i>
                        Add New Goal
                    </a>
                </button>

            </div>
            <div class="goalItemsTableBody">
                <table class="goalItems">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th></th>



                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($goalitems as $goalitem): ?>
                            <tr>
                                <td>
                                    <?= $goalitem['name'] ?>
                                </td>
                                <td>
                                    <span class="type"><?= $goalitem['type'] ?></span>
                                </td>
                                <td>
                                    <?= $goalitem['status'] ?>
                                </td>

                                <td>
                                    <a href="updateGoalItem.php?goal_id=<?= $goalitem['id'] ?>" class="editGoalItem">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="deleteGoalItem.php?goal_id=<?= $goalitem['id'] ?>" class="deleteGoalItem">
                                    <i class="fa fa-trash"></i>
                                    </a>
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