<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];

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

                        <tr>
                            <td>
                                <i class="fa fa-newspaper-o fa-2x text-navy" style="color:#4caf50;"></i>
                                
                            </td>
                            <td>
                                News Title
                            </td>
                            <td>
                                News Category
                            </td>
                            <td>
                                Albin Smajli
                            </td>
                            <td>
                                05.08.2024
                            </td>
                            <td>
                                09.08.2024
                            </td>
                            <td>
                                <a href="" class="btn btn-xs btn-circle btn-outline btn-info m-l-sm"> <i class="fa fa-edit"></i> </a>
                               <button class="btn btn-xs btn-circle btn-outline btn-danger m-l-sm"> <i class="fa fa-trash"></i> </button>
                            </td>
                        </tr>

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