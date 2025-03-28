<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$limit = 10;
$start = ($page - 1) * $limit;
$next = $page + 1;
$previous = $page - 1;

 
    $sql = "SELECT * From timeoffrequests
 WHERE User_ID =$userId
 ORDER BY timeoffrequests.request_id DESC LIMIT $start , $limit ";
    $prep = $con->prepare($sql);
    $prep->execute();
    $requestDatas = $prep->fetchAll();

    $sql_count = "SELECT * From timeoffrequests
 WHERE User_ID =$userId
 ORDER BY timeoffrequests.request_id ";
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
    <link rel="stylesheet" href="../css/request.css">
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
                    My Time Off/Leave Requests
                </h5>
                <button><a href="newrequest.php"><i class="fa fa-plus"></i> Add Time Off/Leave Request</a></button>
            </div>
            <div class="requestTableBody">
                <table class="recentLeave">
                    <thead>
                        <tr>
                            <th>Time Off/Leave Type</th>
                            <th>Reason</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Duration</th>
                            <th>Status</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($requestDatas as $requestData): ?>
                            <tr>
                                <td>
                                    <?= $requestData['leave_type'] ?>
                                </td>
                                <td>
                                    <ul>
                                        <li>
                                            <?= $requestData['short_description'] ?>
                                        </li>
                                        <li>
                                            <?= $requestData['reason'] ?>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <?= $requestData['from'] ?>
                                </td>
                                <td>
                                    <?= $requestData['to'] ?>
                                </td>
                                <td>
                                    <?= $requestData['duration'] ?> Days
                                </td>
                                <td>
                                    <?php if ($requestData['status'] == 'Submited') { ?>
                                        <span class='submited'>
                                            <?= $requestData['status'] ?>
                                        </span>
                                    <?php } elseif ($requestData['status'] == 'Approved') { ?>
                                        <span class='approved'>
                                            <?= $requestData['status'] ?>
                                        </span>
                                    <?php } elseif ($requestData['status'] == 'Declined') { ?>
                                        <span class='decline'>
                                            <?= $requestData['status'] ?>
                                        </span>
                                    <?php } ?>
                                </td>
                                <td><a href="" data-bs-toggle="modal"
                                        data-bs-target="#requestInfoModal<?php echo $requestData['request_id']; ?>"
                                        data-bs-whatever="@mdo" class="info"><i class="fa-solid fa-magnifying-glass"></i>
                                        info</a>
                                </td>
                                <?php if ($requestData['status'] == 'Submited'): ?>
                                    <td><a href="" data-bs-toggle="modal"
                                            data-bs-target="#deleteRequestModal<?php echo $requestData['request_id']; ?>"
                                            data-bs-whatever="@mdo" class="delete"><i class="fa-solid fa-trash-can"></i> Delete
                                            request</a></td>
                                <?php endif; ?>
                                <!-- Modal -->
                                <div class="modal fade modal-fullscreen-lg-down modal-lg"
                                    id="deleteRequestModal<?php echo $requestData['request_id']; ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog mx-auto">
                                        <div class="modal-content">
                                            <div class="d-flex justify-content-center p-5">
                                                <i class="fa-solid fa-circle-exclamation "
                                                    style="color: #e53935; font-size:200px;"></i>
                                            </div>
                                            <div class="modal-body d-flex flex-column d-flex align-items-center ">

                                                <h1 class="fs-1">Delete leave request - Are you sure?</h1>
                                                <p>Are you sure you want to delete this time off/leave request:'
                                                    <?= $requestData['short_description'] ?>'?
                                                </p>
                                            </div>
                                            <div class=" d-flex justify-content-center p-5">
                                                <button type="button" class="btn btn-secondary btn-lg me-2"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-danger btn-lg ms-2">
                                                    <a href="pages/deleteRequest.php?request_id=<?= $requestData['request_id']; ?>"
                                                        class="link-offset-2 link-underline link-underline-opacity-0 text-light">
                                                        Yes, Delete it!</a>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade-requestInfoModal"
                                    id="requestInfoModal<?php echo $requestData['request_id']; ?>" tabindex="-1"
                                    aria-labelledby="requestInfoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Leave Request Info</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <?php if ($requestData['status'] == 'Submited') { ?>
                                                    <p>
                                                        <?= $requestData['from'] ?> to
                                                        <?= $requestData['to'] ?> (
                                                        <?= $requestData['duration'] ?> Days)
                                                    </p>
                                                    <hr>

                                                    <div class="requestInfoIcones"><i class="fa-solid fa-pencil"
                                                            style="color: #fff; background-color: #26c6da; border-color:#26c6da;"></i>
                                                        <?php
                                                        $currentDate = gmdate('Y-m-d');
                                                        $currentDate = date_create($currentDate);
                                                        $createdDate = $requestData['created'];
                                                        $createdDate = date_create($createdDate);

                                                        $createdFor = date_diff($createdDate, $currentDate);

                                                        echo '<p class=".p-3"> ' . 'Created ' . $createdFor->format('%R%a days') . '</p>';
                                                        ?>

                                                    </div>
                                                    <div class="requestInfoIcones "><i class="fa fa-fw2 fa-code-fork"
                                                            style="color: #808486; background-color: #fff; border:1px solid #e7eaec;"></i>
                                                        <p>Approval Rule All staff</p>
                                                    </div>
                                                    <div class="requestInfoIcones"><i class="fa fa-fw2 fa-send "
                                                            style="color: #fff; background-color: #2196f3; border-color:#2196f3;"></i>
                                                        <p>Sent to <Strong>
                                                                <?= $leaderName ?>
                                                                <?= $leaderSurname ?>
                                                            </Strong> and <Strong>
                                                                <?= $HR ?>
                                                            </Strong></p>
                                                    </div>
                                                <?php } else if ($requestData['status'] == 'Approved') { ?>

                                                        <p>
                                                        <?= $requestData['from'] ?> to
                                                        <?= $requestData['to'] ?> (
                                                        <?= $requestData['duration'] ?> Days)
                                                        </p>
                                                        <hr>

                                                        <div class="requestInfoIcones"><i class="fa-solid fa-pencil"
                                                                style="color: #fff; background-color: #26c6da; border-color:#26c6da;"></i>
                                                            <?php
                                                            $currentDate = gmdate('Y-m-d');
                                                            $currentDate = date_create($currentDate);
                                                            $createdDate = $requestData['created'];
                                                            $createdDate = date_create($createdDate);

                                                            $createdFor = date_diff($createdDate, $currentDate);

                                                            echo '<p> ' . 'Created ' . $createdFor->format('%R%a days') . '</p>';
                                                            ?>

                                                        </div>
                                                        <div class="requestInfoIcones"><i class="fa fa-fw2 fa-code-fork"
                                                                style="color: #808486; background-color: #fff; border:1px solid #e7eaec;"></i>
                                                            <p>Approval Rule All staff</p>
                                                        </div>
                                                        <div class="requestInfoIcones"><i class="fa fa-fw2 fa-send "
                                                                style="color: #fff; background-color: #2196f3; border-color:#2196f3;"></i>
                                                            <p>Sent to <Strong>
                                                                <?= $leaderName ?>
                                                                <?= $leaderSurname ?>
                                                                </Strong> and <Strong>
                                                                <?= $HR ?>
                                                                </Strong></p>
                                                        </div>
                                                        <div class="requestInfoIcones"><i class="fa fa-fw2 fa-check "
                                                                style="color: #fff; background-color: #4caf50; border-color:#4caf50;"></i>
                                                            <p>Approved by
                                                                <Strong>
                                                                <?= $leaderName ?>
                                                                <?= $leaderSurname ?>
                                                                </Strong> 26 days ago
                                                            </p>
                                                        </div>
                                                <?php } else { ?>
                                                        <p>
                                                        <?= $requestData['from'] ?> to
                                                        <?= $requestData['to'] ?> (
                                                        <?= $requestData['duration'] ?> Days)
                                                        </p>
                                                        <hr>

                                                        <div class="requestInfoIcones"><i class="fa-solid fa-pencil"
                                                                style="color: #fff; background-color: #26c6da; border-color:#26c6da;"></i>
                                                            <?php
                                                            $currentDate = gmdate('Y-m-d');
                                                            $currentDate = date_create($currentDate);
                                                            $createdDate = $requestData['created'];
                                                            $createdDate = date_create($createdDate);

                                                            $createdFor = date_diff($createdDate, $currentDate);

                                                            echo '<p> ' . 'Created ' . $createdFor->format('%R%a days') . '</p>';
                                                            ?>

                                                        </div>
                                                        <div class="requestInfoIcones"><i class="fa fa-fw2 fa-code-fork"
                                                                style="color: #808486; background-color: #fff; border:1px solid #e7eaec;"></i>
                                                            <p>Approval Rule All staff</p>
                                                        </div>
                                                        <div class="requestInfoIcones"><i class="fa fa-fw2 fa-send "
                                                                style="color: #fff; background-color: #2196f3; border-color:#2196f3;"></i>
                                                            <p>Sent to <Strong>
                                                                <?= $leaderName ?>
                                                                <?= $leaderSurname ?>
                                                                </Strong> and <Strong>
                                                                <?= $HR ?>
                                                                </Strong></p>
                                                        </div>
                                                        <div class="requestInfoIcones">
                                                            <p
                                                                style="color: #ffff; background-color: #ff0000; border-color:#ff0000; padding:5px;">
                                                                Declined by
                                                                <Strong>
                                                                <?= $leaderName ?>
                                                                <?= $leaderSurname ?>
                                                                </Strong> 26 days ago
                                                            </p>
                                                    <?php } ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="paginationn">
                    <ul>
                        <li><a href="request.php?page=1">
                                << </a>
                        </li>
                        <li><a href="request.php?page=<?php echo $previous == 0 ? 1 : $previous ?>">
                                < </a>
                        </li>
                        <?php for ($i = 1; $i <= $total_page; $i++) {
                            $current_page = $page;
                            $previous_2 = $current_page - 2;
                            $next_2 = $current_page + 2;
                            if ($i >= $previous_2 && $i <= $next_2) {
                                ?>
                                <li><a href="request.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php }
                        } ?>
                        <li><a href="request.php?page=<?php echo $next > $total_page ? $total_page : $next ?>">></a>
                        </li>
                        <li><a href="request.php?page=<?php echo $total_page ?>">>></a></li>
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