<?php
$userId = $_SESSION['user_id'];


if ($_SESSION['role'] == 0) {
    $sql = "SELECT * FROM timeoffrequests
    right join users on users.user_id = timeoffrequests.User_ID
    WHERE timeoffrequests.Head_ID =$userId and timeoffrequests.status LIKE 'Submited'
    ORDER BY timeoffrequests.request_id DESC";
    $prep = $con->prepare($sql);
    $prep->execute();
    $requestDatas = $prep->fetchAll();

} else if ($_SESSION['role'] == 1) {
    $sql = "SELECT * FROM timeoffrequests
  right join users on users.user_id = timeoffrequests.User_ID
        WHERE timeoffrequests.status LIKE 'Submited'
        ORDER BY timeoffrequests.request_id DESC";
    $prep = $con->prepare($sql);
    $prep->execute();
    $requestDatas = $prep->fetchAll();
}

include 'approverequestLogic.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/approveRequest.css">
    <script type="text/javascript" src="js/index.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<div class="ApproveRequestsBody">
<table class="recentLeave">
        <thead>
            <tr>
                <td>Name</td>
                <td>Leave type</td>
                <td>Description</td>
                <td>Reason</td>
                <td>From</td>
                <td>To</td>
                <td>Duration</td>
                <td>Aprove | Decline</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requestDatas as $requestData): ?>
                <tr>
                    <td>
                        <?= $requestData['name'] ?>
                        <?= $requestData['surname'] ?>
                    </td>
                    <td>
                        <?= $requestData['leave_type'] ?>
                    </td>
                    <td>
                        <?= $requestData['reason'] ?>
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
                        <form action="" method="POST">
                            <input type="hidden" name="leave_type" value="<?= $requestData['leave_type']; ?>">
                            <input type="hidden" name="request_id" value="<?= $requestData['request_id']; ?>">
                            <input type="hidden" name="requestUserId" value="<?= $requestData['User_ID']; ?>">
                            <input type="hidden" name="duration" value="<?= $requestData['duration']; ?>">
                            <button type="Submit" name="Approve" id="Approve">Approve</button>
                            <button type="Submit" name="Decline" id="Decline">Decline</button>
                        </form>
                    </td>
                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</html>