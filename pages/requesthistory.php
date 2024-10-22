<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$limit = 30;
$start = ($page - 1) * $limit;
$next = $page + 1;
$previous = $page - 1;



$sql = "SELECT * From timeoffrequests
    WHERE User_ID =$userId and `status` LIKE 'Approved' or `status` LIKE 'Declined'
    ORDER BY timeoffrequests.request_id DESC";
$prep = $con->prepare($sql);
$prep->execute();
$requestDatas = $prep->fetchAll();

$sql_count = "SELECT * From timeoffrequests
    WHERE User_ID =$userId and `status` LIKE 'Approved' or `status` LIKE 'Declined'
    ORDER BY timeoffrequests.request_id DESC";
$prep = $con->prepare($sql_count);
$prep->execute();
$total_datas = $prep->rowCount();

$total_page = ceil($total_datas / $limit);




?>

<?php
include_once 'GetLeadAndHR.php';
?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/requsetHistory.css">
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
        <?php include '../template/sidebar.php' ?>
    </div>
    <div class="content">
        <?php include '../template/navbar.php' ?>
        <div class="requestHead">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>
        <div class="requestBody">
            <div class="requestTableHead">
                <h5>
                    <img src="../images/absence.png" alt="" width="25px" height="25px">
                    Approve Time Off/Leave Requests
                </h5>
            </div>
            <div class="requestTableBody">
                <table class="recentLeave">
                    <thead>
                        <tr>
                            <td>Leave type</td>
                            <td>Description</td>
                            <td>Start Date</td>
                            <td>End Date</td>
                            <td>Duration</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($requestDatas as $requestData): ?>
                            <tr>
                                <td>
                                    <?= $requestData['leave_type'] ?>
                                </td>
                                <td>
                                    <?= $requestData['short_description'] ?>
                                </td>
                                <td>
                                    <?= $requestData['from'] ?>
                                </td>
                                <td>
                                    <?= $requestData['to'] ?>
                                </td>
                                <td>
                                    <?= $requestData['duration'] ?>
                                </td>
                                <td>
                                    <?= $requestData['status'] ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="paginationn">
                    <ul>
                        <li><a href="requesthistory.php?page=1">
                                << </a>
                        </li>
                        <li><a href="requesthistory.php?page=<?php echo $previous == 0 ? 1 : $previous ?>">
                                < </a>
                        </li>
                        <?php for ($i = 1; $i <= $total_page; $i++) {
                            $current_page = $page;
                            $previous_2 = $current_page - 2;
                            $next_2 = $current_page + 2;
                            if ($i >= $previous_2 && $i <= $next_2) {
                                ?>
                                <li><a href="requesthistory.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php }
                        } ?>
                        <li><a href="requesthistory.php?page=<?php echo $next > $total_page ? $total_page : $next ?>">></a>
                        </li>
                        <li><a href="requesthistory.php?page=<?php echo $total_page ?>">>></a></li>
                    </ul>
                </div>
                <div>

                </div>
            </div>
        </div>
        <?php include '../template/footer.php'; ?>
    </div>
</body>

</html>