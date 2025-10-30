<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$company_Id = $_SESSION['company'];

include 'addAuthUsersLogic.php';
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
        <?php include '../template/adminSidebar.php' ?>
    </div>
    <div class="content">
        <?php include '../template/navbar.php' ?>
        <div class="authUserHead">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>
        <div class="authUserBody">
            <div class="authUserTableHead">
                <h5>
                    Authorised Users
                </h5>
                <button id="addAuthUser" data-bs-toggle="modal" data-bs-target="#addExpensesModal"
                    data-bs-whatever="@mdo">
                    <a href="addNewAuthUser.php">
                        <i class="fa fa-plus"></i>
                        Add A New User
                    </a>
                </button>
            </div>
            <div class="authUserTableBody">
                <table class="authorisedUseres">
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
                        <?php foreach ($authusers as $authuser): ?>
                            <tr>
                                <td>
                                    <?= $authuser['name'] ?>
                                    <?= $authuser['surname'] ?>
                                </td>
                                <td>
                                    <?= $authuser['email'] ?>
                                </td>
                                <td>
                                    20 minutes ago
                                </td>
                                <td>
                                    √
                                </td>
                                <td>
                                    √
                                </td>
                                <td>
                                    <button id="editAuthUser" data-bs-toggle="modal" data-bs-target="#addExpensesModal"
                                        data-bs-whatever="@mdo">
                                        <a>
                                            <i class=" fa fa-edit"></i>
                                            Edit
                                        </a>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div>
                    <p>You are using <strong>1</strong> admin users out of <strong>10</strong> allowed</p>
                </div>
            </div>
        </div>
        <?php include '../template/footer.php'; ?>
    </div>
</body>

</html>