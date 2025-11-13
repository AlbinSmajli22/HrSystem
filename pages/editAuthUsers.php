<?php
require_once '../config.php';
session_start();
$company_Id = $_SESSION['company'];
include 'addAuthUsersLogic.php';
$admin_id=$_GET['admin_id'];
$sql="SELECT * FROM admins where admin_id=:admin_id";
$prep=$con->prepare($sql);
$prep->bindParam(':admin_id', $admin_id);
$prep->execute();
$admin=$prep->fetch();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/editAuthUser.css">
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
        <div class="newArticleHead">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>

        <div class="newArticleBody">
            <div class="ArticleHead">
                <h4>
                    Edit User Details
                </h4>
            </div>
            <div class="ArticleBody">

                <form action="" method="post">
                    <div class="ArticleBody-top">
                        <div class="ArticleBody-left">
                            <div class="form-group">
                                <label for="firsName">First Name</label><br>
                                <input type="text" name="firsName" id="firsName" value="<?=$admin['name'] ?>">
                                <input type="hidden" name="admin_id" id="admin_id" value="<?=$admin['admin_id'] ?>">

                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label><br>
                                <input type="text" name="lastName" id="lastName" value="<?=$admin['surname'] ?>">

                            </div>
                            <div class="form-group">
                                <label for="email">Email</label><br>
                                <input type="text" readonly name="email" id="email" value="<?=$admin['email'] ?>">
                            </div>
                        </div>
                        <div class="ArticleBody-right">
                            <button>
                                <i class="fa fa-trash"></i>
                                <a href="deleteAuthUser.php?admin_id=<?= $admin['admin_id'] ?>"> Delete this user</a>
                            </button>
                        </div>
                    </div>


                    <hr>
                    <div class="ArticleBody-bottom">
                        <div class="form-group">
                            <label for="existEmp">Link to Company Employee</label><br>
                            <select name="existEmp" id="existEmp">
                                <option value="" disabled selected>Select a user</option>
                                <?php foreach ($users as $user): ?>
                                    <option value="<?= $user['user_id'] ?>"><?= $user['name'] ?>     <?= $user['surname'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p>If the admin user also ha access to the employee portal, select their employee records
                                here
                                to allow them to easily switch between their admin and employee portals.</p>
                        </div>
                    </div>



                    <div class="ArticleFooter">
                        <button type="submit" name="editAuthUser">Save</button>
                        <a href="authorisedUsers.php" class="cancel">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <?php include '../template/footer.php'; ?>
    </div>

</body>

</html>