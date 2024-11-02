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


 // Step 1: Handle form submission to update balances
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['balances'] as $userId => $leaveBalances) {
        foreach ($leaveBalances as $leaveTypeId => $balanceData) {
            $balance = $balanceData['balance'];
            $balanceId = $balanceData['balance_id'];

            if ($balanceId && is_numeric($balance)) {
                // Update the balance in the database
                $updateQuery = "
                    UPDATE amountoftimeoff
                    SET balance = :balance
                    WHERE id = :balanceId
                ";
                $updateStmt = $con->prepare($updateQuery);
                $updateStmt->execute([
                    ':balance' => $balance,
                    ':balanceId' => $balanceId,
                ]);
            } elseif (is_numeric($balance)) {
                // Insert new balance if it doesn't exist
                $insertQuery = "
                    INSERT INTO amountoftimeoff (user_id, time_off_type, balance)
                    VALUES (:userId, :leaveTypeId, :balance)
                ";
                $insertStmt = $con->prepare($insertQuery);
                $insertStmt->execute([
                    ':userId' => $userId,
                    ':leaveTypeId' => $leaveTypeId,
                    ':balance' => $balance,
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
        $columns[] = "MAX(CASE WHEN a.time_off_type = $leaveTypeId THEN a.balance END) AS `" . htmlspecialchars($leaveName) . " (Days)`";
        $columns[] = "MAX(CASE WHEN a.time_off_type = $leaveTypeId THEN a.id END) AS `" . htmlspecialchars($leaveName) . " (Balance ID)`";
    }

    $columnsSql = implode(", ", $columns);
 
    $balanceQuery = " SELECT 
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

    $stmt = $con->prepare($balanceQuery);
    $stmt->bindParam(':companyId', $companyId, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);



    $balance_count = "SELECT 
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

$prep = $con->prepare($balance_count);
$prep->bindParam(':companyId', $companyId, PDO::PARAM_INT);
$prep->execute();
$total_datas = $prep->rowCount();

$total_page = ceil($total_datas / $limit);
/*
$sql="SELECT 
    u.name AS Employee,
    u.surname AS LastName,
    u.user_id AS Code,
    MAX(CASE WHEN t.time_off = 'Annual Leave' THEN a.balance END) AS 'Annual Leave (Days)',
    MAX(CASE WHEN t.time_off = 'Sick Leave' THEN a.balance END) AS 'Sick Leave (Days)',
    MAX(CASE WHEN t.time_off = 'Wedding Day ' THEN a.balance END) AS 'Wedding Day (Days)',
    MAX(CASE WHEN t.time_off = 'Moving Day' THEN a.balance END) AS 'Moving Day (Days)',
    MAX(CASE WHEN t.time_off = 'Child Born' THEN a.balance END) AS 'Child Born (Days)',
     MAX(CASE WHEN t.time_off = 'Death Of Family Member' THEN a.balance END) AS 'Death Of Family Member (Days)'
    -- Add more leave types as needed
FROM 
    hrsystem.users u
JOIN 
    hrsystem.amountoftimeoff a ON u.user_id = a.user_id
JOIN 
    hrsystem.timeofftype t ON a.time_off_type = t.id
WHERE 
    u.company = 1 -- Replace <YourCompanyID> with the specific company ID if filtering by a particular company
GROUP BY 
    u.name, u.user_id
ORDER BY 
    u.name";
$prep = $con->prepare($sql);
$prep->execute();
$amounts = $prep->fetchAll();
*/

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
                    Employee Current Leave Balances
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
                                    $balanceField = "{$leaveName} (Days)";
                                    $balanceIdField = "{$leaveName} (Balance ID)";
                                    $balance = $result[$balanceField] ?? '0';
                                    $balanceId = $result[$balanceIdField] ?? 'N/A';
                                    ?>
                                    
                                <td>
                                <input type="hidden" name="balances[<?= $result['Code'] ?>][<?= $leaveType['id'] ?>][balance_id]" id="" value="<?= $balanceId  ?>">
                                <input type="number" step='0.1' name="balances[<?= $result['Code'] ?>][<?= $leaveType['id'] ?>][balance]" id="" value="<?= $balance ?>">
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
                        <li><a href="balances.php?page=1">
                                << </a>
                        </li>
                        <li><a href="balances.php?page=<?php echo $previous == 0 ? 1 : $previous ?>">
                                < </a>
                        </li>
                        <?php for ($i = 1; $i <= $total_page; $i++) {
                            $current_page = $page;
                            $previous_2 = $current_page - 2;
                            $next_2 = $current_page + 2;
                            if ($i >= $previous_2 && $i <= $next_2) {
                                ?>
                                <li><a href="balances.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php }
                        } ?>
                        <li><a
                                href="balances.php?page=<?php echo $next > $total_page ? $total_page : $next ?>">></a>
                        </li>
                        <li><a href="balances.php?page=<?php echo $total_page ?>">>></a></li>
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