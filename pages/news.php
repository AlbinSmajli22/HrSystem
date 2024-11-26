<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];


$NewQuery = "SELECT * FROM news RIGHT JOIN users ON news.author=users.user_id 
WHERE company_id=:company_id";
$prep = $con->prepare($NewQuery);
$prep->bindParam(':company_id', $companyId);
$prep->execute();
$News = $prep->fetchAll();



if (isset($_POST['editNews'])) {

    $new_id=$_POST['new_id'];
    $company_id=$_POST['company_id'];
    $title=$_POST['title'];
    $category=$_POST['category'];
    $summary=$_POST['summary'];
    $content=$_POST['content'];
    $created=date('y-m-d');
    $publish_on=$_POST['publish_on'];
    $until=$_POST['until'];


	$editNewsQuery = "UPDATE news SET title=:title, category=:category, summary=:summary, content=:content, publish_on=:publish_on, until=:until, author=:author,  created=:created, company_id=:company_id
        WHERE new_id =:new_id ";



    $prep = $con->prepare($editNewsQuery);

    $prep=$con->prepare($editNewsQuery);
    $prep->bindParam(':new_id', $new_id);
    $prep->bindParam(':author', $userId);
    $prep->bindParam(':company_id', $company_id);
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
    <link rel="stylesheet" href="../css/news.css">
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
            <div class="newsTableHead">
                <h5>
                    News Article / Polls
                </h5>
                <button><a href="addNewArticle.php"><i class="fa fa-plus"></i> Add A New</a></button>
            </div>
            <div class="newsTableBody">
                <table class="recentNews">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Publish</th>
                            <th>Until</th>
                            <th></th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($News as $New): ?>
                            <tr>
                                <td>
                                    <i class="fa fa-newspaper-o fa-2x text-navy" style="color:#4caf50;"></i>

                                </td>
                                <td>
                                    <?= $New['title'] ?>
                                </td>
                                <td>
                                    <?= $New['category'] ?>
                                </td>
                                <td>
                                    <?= $New['name'] ?>     <?= $New['surname'] ?>
                                </td>
                                <td>
                                    <?= $New['publish_on'] ?>
                                </td>
                                <td>
                                    <?= $New['until'] ?>
                                </td>
                                <td>
                                    <button class=" btn btn-xs btn-circle btn-outline btn-info m-l-sm"
                                        data-bs-toggle="modal" data-bs-target="#newsEditModal<?php echo $New['new_id']; ?>"
                                        data-bs-whatever="@mdo"> <i class=" fa fa-edit"></i> </button>
                                    <a href="deleteNew.php?new_id=<?= $New['new_id']; ?>"
                                        class="btn btn-xs btn-circle btn-outline btn-danger m-l-sm"> <i
                                            class="fa fa-trash"></i> </a>
                                </td>
                                <div class="modal fade-newsEditModal" id="newsEditModal<?php echo $New['new_id']; ?>"
                                    tabindex="-1" aria-labelledby="newsEditModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="" method="post">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit News</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                    <input type="hidden" name="new_id" id="new_id" value="<?= $New['new_id'] ?>">
                                                    <input type="hidden" name="company_id" id="company_id" value="<?= $_SESSION['company'] ?>">
                                                    <label for="title">Title</label>
                                                    <input type="text" name="title" id="title" value="<?= $New['title'] ?>">
                                                    <label for="summary">Summary</label>
                                                    <input type="text" name="summary" id="summary" value="<?= $New['summary'] ?>">
                                                    <label for="content">Content</label>
                                                    <input type="text" name="content" id="content" value="<?= $New['content'] ?>">
                                                    <label for="category">Category</label>
                                                    <select name="category" id="category">
                                                        <option value="<?= $New['category'] ?>"><?= $New['category'] ?></option>
                                                        <option value="Breaking">Breaking</option>
                                                    </select>
                                                    <label for="publish_on">Publish</label>
                                                    <input type="date" name="publish_on" id="publish_on" value="<?= $New['publish_on'] ?>">
                                                    <label for="">Until</label>
                                                    <input type="date" name="until" id="until" value="<?= $New['until'] ?>">
                                                
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" name="editNews" class="btn btn-success">Edit</button>
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