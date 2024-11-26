<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$new_id=$_GET['new_id'];

$NewQuery="SELECT * FROM news RIGHT JOIN users ON news.author=users.user_id 
WHERE new_id=:new_id";
$prep = $con->prepare($NewQuery);
$prep->bindParam(':new_id', $new_id);
$prep->execute();
$News= $prep->fetch();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/theNew.css">
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
        <div class="newsHead">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>

        <div class="newsBody">
            <div id="theNewContent">
                <div id="category">
                    <span><?=$News['category']?></span>
                </div>
                <div id="title">
                    <span><i class="fa fa-clock-o"></i> <?=$News['publish_on']?></span>
                    <h1><?=$News['summary']?></h1>
                </div>
                <div id="well">
                    <p><?=$News['summary']?></p>
                </div>
                <p id="content"><?=$News['content']?></p>
                <hr>
                <div id="goBack">
                    <a href="empNews.php">
                        <i class="fa fa-chevron-left"></i>
                         Back To Company News</a>
                </div>
                <div class="comments">
                    <h1>Comments:</h1>
                    <textarea name="" id="" placeholder="Enter your comment..."></textarea>
                    <div>
                        <button type="submit" name="postComment">Post Comment</button>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../template/footer.php'; ?>
    </div>

</body>

</html>