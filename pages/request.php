<?php 
    require_once './config.php';


    $sql='SELECT * From timeoffrequests';
    $prep=$con->prepare($sql);
    $prep->execute();
    $requestDatas= $prep->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/request.css">
    <title>Document</title>
</head>
<div class="requestHead">
    <h2>MetDaan</h2>
</div>
<div class="requestBody">
    <div class="requestTableHead">
        <h5>
            <img src="./images/absence.png" alt="" width="25px" height="25px">
            My Time Off/Leave Requests
        </h5>
        <button><a href="?page=newrequest">+Add Time Off/Leave Request</a></button>
    </div>
    <div class="requestTableBody">
        <table>
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
                <?php foreach($requestDatas as $requestData): ?>
                <tr>
                    <td> <?=$requestData['leave_type']?></td>
                    <td>
                        <ul>
                            <li> <?=$requestData['short_description']?></li>
                            <li><?=$requestData['reason']?></li>
                        </ul>
                    </td>
                    <td><?=$requestData['from']?></td>
                    <td><?=$requestData['to']?></td>
                    <td><?=$requestData['duration']?> Days</td>
                    <td><button><?=$requestData['status']?></button></td>
                    <td>info</td>
                </tr>
             <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>
</html>