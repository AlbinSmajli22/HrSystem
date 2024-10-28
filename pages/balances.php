<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];

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
    }

    $columnsSql = implode(", ", $columns);

    $balanceQuery = "SELECT 
            u.name AS Employee,
            u.surname AS LastName ,
            u.user_id AS Code,
            $columnsSql
        FROM 
            users u
        JOIN 
            amountoftimeoff a ON u.user_id = a.user_id
        WHERE 
            u.company = :companyId
        GROUP BY 
            u.name, u.user_id
        ORDER BY 
            u.user_id;
    ";

    $stmt = $con->prepare($balanceQuery);
    $stmt->bindParam(':companyId', $companyId, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);




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
                    <img src="../images/absence.png" alt="" width="25px" height="25px">
                    Approve Time Off/Leave Requests
                </h5>
            </div>
            <div class="requestTableBody">
                <table class="recentLeave">
                    <thead>
                        <tr>
                            <td>Employee</td>
                            <td>Code</td>
                            <?php foreach ($leaveTypes as $leaveType): ?>
                                <td><?= $leaveType['time_off'] ?></td>
                            <?php endforeach; ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $result): ?>
                            <tr>
                                <td> <?= $result['Employee'] ?> <?= $result['LastName'] ?> </td>
                                <td>EMP<?= $result['Code'] ?> </td>

                                <?php foreach ($leaveTypes as $leaveType){ 
                                    $leaveName = $leaveType['time_off'] . " (Days)";
                                    ?>
                                <td> <?= $result[$leaveName] ?? 0 ?> </td>
                                <?php } ?>
                                
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
                        <li><a
                                href="requesthistory.php?page=<?php echo $next > $total_page ? $total_page : $next ?>">></a>
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