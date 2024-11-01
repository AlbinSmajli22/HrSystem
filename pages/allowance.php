<?php
// Database connection
$host = 'localhost';
$dbname = 'hrsystem';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Define the company ID if filtering by a specific company
    $companyId = 1; // Replace this with the desired company ID

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
                    $updateStmt = $pdo->prepare($updateQuery);
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
                    $insertStmt = $pdo->prepare($insertQuery);
                    $insertStmt->execute([
                        ':userId' => $userId,
                        ':leaveTypeId' => $leaveTypeId,
                        ':balance' => $balance,
                    ]);
                }
            }
        }
        echo "<p>Balances updated successfully!</p>";
    }

    // Step 2: Fetch all leave types for the specified company
    $leaveTypeQuery = "
        SELECT id, time_off
        FROM timeofftype
        WHERE company_id = :companyId
    ";
    $stmt = $pdo->prepare($leaveTypeQuery);
    $stmt->bindParam(':companyId', $companyId, PDO::PARAM_INT);
    $stmt->execute();
    $leaveTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Build dynamic SQL for each leave type as a column, with balance and balance_id
    $columns = [];
    foreach ($leaveTypes as $leaveType) {
        $leaveTypeId = $leaveType['id'];
        $leaveName = $leaveType['time_off'];
        $columns[] = "MAX(CASE WHEN a.time_off_type = $leaveTypeId THEN a.balance END) AS `" . htmlspecialchars($leaveName) . " (Days)`";
        $columns[] = "MAX(CASE WHEN a.time_off_type = $leaveTypeId THEN a.id END) AS `" . htmlspecialchars($leaveName) . " (Balance ID)`";
    }
    $columnsSql = implode(", ", $columns);

    // Step 3: Fetch user leave balances dynamically based on leave types with balance IDs
    $balanceQuery = "
        SELECT 
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
            u.user_id;
    ";

    $stmt = $pdo->prepare($balanceQuery);
    $stmt->bindParam(':companyId', $companyId, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the form with an editable table
    echo "<form method='post'>";
    echo "<table border='1'>";
    echo "<tr><th>Employee</th><th>Code</th>";

    // Output dynamic headers for each leave type (balance and balance ID)
    foreach ($leaveTypes as $leaveType) {
        $leaveName = htmlspecialchars($leaveType['time_off']);
        echo "<th>{$leaveName} (Days)</th>";
        echo "<th>{$leaveName} (Balance ID)</th>";
    }
    echo "</tr>";

    // Output each user's leave balances
    foreach ($results as $row) {
        $userId = $row['Code'];
        echo "<tr>";
        echo "<td>{$row['Employee']}</td>";
        echo "<td>{$userId}</td>";

        foreach ($leaveTypes as $leaveType) {
            $leaveName = htmlspecialchars($leaveType['time_off']);
            $balanceField = "{$leaveName} (Days)";
            $balanceIdField = "{$leaveName} (Balance ID)";
            $balance = isset($row[$balanceField]) ? $row[$balanceField] : '0';
            $balanceId = isset($row[$balanceIdField]) ? $row[$balanceIdField] : '';

            echo "<td><input type='number' step='0.1' name='balances[$userId][{$leaveType['id']}][balance]' value='{$balance}'></td>";
            echo "<td><input type='text' name='balances[$userId][{$leaveType['id']}][balance_id]' value='{$balanceId}' readonly></td>";
        }

        echo "</tr>";
    }

    echo "</table>";
    echo "<button type='submit'>Save Changes</button>";
    echo "</form>";

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>