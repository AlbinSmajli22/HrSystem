<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];

$NewQuery="SELECT * FROM news RIGHT JOIN users ON news.author=users.user_id 
WHERE company_id=:company_id";
$prep = $con->prepare($NewQuery);
$prep->bindParam(':company_id', $companyId);
$prep->execute();
$News= $prep->fetchAll();


$today = date('Y-m-d');

$deleteNews="DELETE FROM news WHERE until = :today";
$prep = $con->prepare($deleteNews);
$prep->bindParam(':today', $today);
$prep->execute();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/empNews.css">
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
            <div id="row">
            <?php foreach($News as $New): ?>
                <div class="inbox">
                    <div class="inbox-content">
                        <a href="theNew.php?new_id=<?= $New['new_id']; ?>">
                            <h2> <?=$New['title']?></h2>
                        </a>
                        <div class="author">
                            <strong><?=$New['name']?> <?=$New['surname']?></strong>
                            <span><i class="fa fa-clock-o" style="font-size: 10px;"></i> 08 Aug 2024</span>
                        </div>
                        <p><?=$New['summary']?></p>
                        <div class="category">
                            <span><?=$New['category']?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php include '../template/footer.php'; ?>
    </div>

</body>

</html>