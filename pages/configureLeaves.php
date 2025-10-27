<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];


if (isset($_POST['AddLeave'])) {
    $time_off = $_POST['time_off'];
    $company_id = $_POST['company_id'];

    $insertLeave = "INSERT INTO timeofftype VALUES(null,:time_off, :company_id)";

    $prep = $con->prepare($insertLeave);
    $prep->bindParam(':time_off', $time_off);
    $prep->bindParam(':company_id', $company_id);
    $prep->execute();

}
if (isset($_POST['editLeave'])) {
    $id = $_POST['id'];
    $time_off = $_POST['time_off'];
    $company_id = $_POST['company_id'];

    $insertLeave = "UPDATE timeofftype SET id=:id, time_off=:time_off, company_id=:company_id WHERE id=:id";

    $prep = $con->prepare($insertLeave);
    $prep->bindParam(':id', $id);
    $prep->bindParam(':time_off', $time_off);
    $prep->bindParam(':company_id', $company_id);
    $prep->execute();

}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$limit = 10;
$start = ($page - 1) * $limit;
$next = $page + 1;
$previous = $page - 1;


$leaveTypeQuery = "SELECT id, time_off
        FROM timeofftype
        WHERE company_id = :companyId
        LIMIT $start , $limit
    ";
$stmt = $con->prepare($leaveTypeQuery);
$stmt->bindParam(':companyId', $companyId, PDO::PARAM_INT);
$stmt->execute();
$leaveTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$leaveTypeCount = "SELECT id, time_off
        FROM timeofftype
        WHERE company_id = :companyId
        
    ";
$prep = $con->prepare($leaveTypeCount);
$prep->bindParam(':companyId', $companyId, PDO::PARAM_INT);
$prep->execute();
$total_datas = $prep->rowCount();

$total_page = ceil($total_datas / $limit);

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/requsetHistory.css">
    <script src="https://kit.fontawesome.com/3d560ffcbd.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
        <div class="requestHead">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>
        <div class="requestBody">
            <div class="requestTableHead">
                <h5>
                    Leave Policies
                </h5>
                <button>
                    <a href="" class="btn btn-xs rounded-circle m-l-sm me-2" data-bs-toggle="modal"
                        data-bs-target="#addLeaveModal">
                        <i class="fa fa-plus"></i> Add Time Off/Leave Request
                    </a>
                </button>
                <div class="modal fade" id="addLeaveModal" tabindex="-1" aria-labelledby="addLeaveModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addLeaveModalLabel">New message</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Leave Name</label>
                                        <input type="text" class="form-control" name="time_off" id="name">
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" class="form-control" name="company_id" id="company_id"
                                            value="<?= $companyId ?>">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="AddLeave" class="btn btn-success">Add Leave</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="requestTableBody">
                <table class="recentLeave">
                    <thead>
                        <tr>

                            <th>Leave Type</th>
                            <th>Units</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($leaveTypes as $leaveType): ?>
                            <tr>
                                <td><?= $leaveType['time_off'] ?></td>
                                <td>Days</td>
                                <td>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $leaveType['id']; ?>"
                                        data-bs-whatever="@mdo">Edit</a>
                                    <a href="deleteLeave.php?leave_id=<?= $leaveType['id']; ?>">Delete</a>
                                </td>
                                <div class="modal fade" id="editModal<?php echo $leaveType['id']; ?>" tabindex="-1"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editModalLabel">New message</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="POST">
                                                    <div class="mb-3">
                                                        <input type="hidden" class="form-control" name="id" id="id" value="<?= $leaveType['id'] ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="name" class="col-form-label">Leave Name</label>
                                                        <input type="text" class="form-control" name="time_off" id="name" value="<?= $leaveType['time_off'] ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" class="form-control" name="company_id"
                                                            id="company_id" value="<?= $companyId ?>">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name="editLeave" class="btn btn-success">Edit
                                                            Leave</button>
                                                    </div>
                                                </form>
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
                        <li><a href="configureLeaves.php?page=1">
                                << </a>
                        </li>
                        <li><a href="configureLeaves.php?page=<?php echo $previous == 0 ? 1 : $previous ?>">
                                < </a>
                        </li>
                        <?php for ($i = 1; $i <= $total_page; $i++) {
                            $current_page = $page;
                            $previous_2 = $current_page - 2;
                            $next_2 = $current_page + 2;
                            if ($i >= $previous_2 && $i <= $next_2) {
                                ?>
                                <li><a href="configureLeaves.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php }
                        } ?>
                        <li><a
                                href="configureLeaves.php?page=<?php echo $next > $total_page ? $total_page : $next ?>">></a>
                        </li>
                        <li><a href="configureLeaves.php?page=<?php echo $total_page ?>">>></a></li>
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