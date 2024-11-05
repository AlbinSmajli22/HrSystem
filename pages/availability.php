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


 // Step 1: Handle form submission to update availables
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['availables'] as $userId => $leaveAvailables) {
        foreach ($leaveAvailables as $leaveTypeId => $availableData) {
            $available = $availableData['available'];
            $availableId = $availableData['available_id'];

            if ($availableId && is_numeric($available)) {
                // Update the available in the database
                $updateQuery = "
                    UPDATE amountoftimeoff
                    SET available = :available
                    WHERE id = :availableId
                ";
                $updateStmt = $con->prepare($updateQuery);
                $updateStmt->execute([
                    ':available' => $available,
                    ':availableId' => $availableId,
                ]);
            } elseif (is_numeric($available)) {
                // Insert new available if it doesn't exist
                $insertQuery = "
                    INSERT INTO amountoftimeoff (user_id, time_off_type, available)
                    VALUES (:userId, :leaveTypeId, :available)
                ";
                $insertStmt = $con->prepare($insertQuery);
                $insertStmt->execute([
                    ':userId' => $userId,
                    ':leaveTypeId' => $leaveTypeId,
                    ':available' => $available,
                ]);
            }
        }
    }
}

   // Step 2: Fetch all leave types for the specified company
$leaveTypeQuery = "SELECT id, time_off
        FROM timeofftype
        WHERE company_id = :companyId
    ";
    $stmt = $con->prepare($leaveTypeQuery);
    $stmt->bindParam(':companyId', $companyId, PDO::PARAM_INT);
    $stmt->execute();
    $leaveTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$columns = [];
    foreach ($leaveTypes as $leaveType) {
        $leaveName = $leaveType['time_off'];
        $leaveTypeId = $leaveType['id'];
        $columns[] = "MAX(CASE WHEN a.time_off_type = $leaveTypeId THEN a.available END) AS `" . htmlspecialchars($leaveName) . " (Days)`";
        $columns[] = "MAX(CASE WHEN a.time_off_type = $leaveTypeId THEN a.id END) AS `" . htmlspecialchars($leaveName) . " (Available ID)`";
    }

    $columnsSql = implode(", ", $columns);
 
    $availableQuery = " SELECT 
            u.user_id AS Code,
            u.name AS Employee,
            u.surname AS LastName ,
            $columnsSql
        FROM 
            users u
        LEFT JOIN 
            amountoftimeoff a ON u.user_id = a.user_id
        WHERE 
            u.company = :companyId
        GROUP BY 
            u.user_id, u.name
        ORDER BY 
            u.name
            LIMIT $start , $limit;
    ";

    $stmt = $con->prepare($availableQuery);
    $stmt->bindParam(':companyId', $companyId, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);



    $available_count = "SELECT 
            u.user_id AS Code,
            u.name AS Employee,
            u.surname AS LastName ,
            $columnsSql
        FROM 
            users u
        LEFT JOIN 
            amountoftimeoff a ON u.user_id = a.user_id
        WHERE 
            u.company = :companyId
        GROUP BY 
            u.user_id, u.name
        ORDER BY 
            u.name;";

$prep = $con->prepare($available_count);
$prep->bindParam(':companyId', $companyId, PDO::PARAM_INT);
$prep->execute();
$total_datas = $prep->rowCount();

$total_page = ceil($total_datas / $limit);


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
                    Employee Current Leave Availables
                </h5>
            </div>
            <div class="requestTableBody">
            <form action="" method="post">
                <table class="recentLeave">
                    <thead>
                        <tr>
                            <td>Employee</td>
                            <td>Code</td>
                            <?php foreach ($leaveTypes as $leaveType): ?>
                                <td><?= $leaveType['time_off'] ?></td>
                            <?php endforeach; ?>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $result): ?>
                            <tr>
                                
                                <td> <?= $result['Employee'] ?> <?= $result['LastName'] ?> </td>
                                <td>EMP<?= $result['Code'] ?> </td>

                                <?php foreach ($leaveTypes as $leaveType){ 
                                    $leaveName = htmlspecialchars($leaveType['time_off']);
                                    $availableField = "{$leaveName} (Days)";
                                    $availableIdField = "{$leaveName} (Available ID)";
                                    $available = $result[$availableField] ?? '0';
                                    $availableId = $result[$availableIdField] ?? 'N/A';
                                    ?>
                                    
                                <td>
                                <input type="hidden" name="availables[<?= $result['Code'] ?>][<?= $leaveType['id'] ?>][available_id]" id="" value="<?= $availableId  ?>">
                                <input type="number" step='0.1' name="availables[<?= $result['Code'] ?>][<?= $leaveType['id'] ?>][available]" id="" value="<?= $available ?>">
                                </td>
                                <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" name="saveLeaves">Save</button>
                </form>
                <div class="paginationn">
                    <ul>
                        <li><a href="availability.php?page=1">
                                << </a>
                        </li>
                        <li><a href="availability.php?page=<?php echo $previous == 0 ? 1 : $previous ?>">
                                < </a>
                        </li>
                        <?php for ($i = 1; $i <= $total_page; $i++) {
                            $current_page = $page;
                            $previous_2 = $current_page - 2;
                            $next_2 = $current_page + 2;
                            if ($i >= $previous_2 && $i <= $next_2) {
                                ?>
                                <li><a href="availability.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php }
                        } ?>
                        <li><a
                                href="availability.php?page=<?php echo $next > $total_page ? $total_page : $next ?>">></a>
                        </li>
                        <li><a href="availability.php?page=<?php echo $total_page ?>">>></a></li>
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