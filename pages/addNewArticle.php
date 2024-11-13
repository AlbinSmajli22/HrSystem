<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$company_Id = $_SESSION['company'];


if (isset($_POST['addNews'])) {
    
    $title=$_POST['title'];
    $category=$_POST['category'];
    $summary=$_POST['summary'];
    $content=$_POST['content'];
    $created=date('y-m-d');
    $publish_on=$_POST['publish_on'];
    $until=$_POST['until'];

    $newsQuery="INSERT INTO news VALUES (null, :title, :category, :summary, :content, :publish_on, :until, :author, :created, :company_id)";
    $prep=$con->prepare($newsQuery);
    $prep->bindParam(':author', $userId);
    $prep->bindParam(':company_id', $company_Id);
    $prep->bindParam(':title', $title);
    $prep->bindParam(':category', $category);
    $prep->bindParam(':summary', $summary);
    $prep->bindParam(':content', $content);
    $prep->bindParam(':publish_on', $publish_on);
    $prep->bindParam(':until', $until);
    $prep->bindParam(':created', $created);

    $prep->execute();
    header("Location: /HrSystem/pages/news.php");
   


    
}





?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/newArticle.css">
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
        <div class="newArticleHead">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>

        <div class="newArticleBody">
            <div class="ArticleHead">
                <h4>
                    <i class="fa fa-newspaper-o"></i>
                    News Article Details
                </h4>
            </div>
            <div class="ArticleBody">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="title">Title</label><br>
                        <input type="text" name="title" id="title">
                        <p>Give your news article a clear and meaningful name that will grab the attention of your
                            employees.</p>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label><br>
                        <select name="category" id="category">
                            <option value="Breaking">Breaking</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="summary">Summary</label><br>
                        <input type="text" name="summary" id="summary">
                        <p>Enter a short summary of the news article that will be shown under the title (optional).</p>
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label><br>
                        <input type="text" name="content" id="content">
                        <p>Type in the main news story</p>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="pulish">Publish On</label><br>
                            <input type="date" name="publish_on" id="pulish">
                        </div>
                        <div class="col">
                            <label for="until">Until</label><br>
                            <input type="date" name="until" id="until">
                        </div>
                    </div>
                    <div class="ArticleFooter">
                        <button type="submit" name="addNews">Save</button>
                        <a href="home.php" class="cancel">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <?php include '../template/footer.php'; ?>
    </div>

</body>

</html>