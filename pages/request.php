<?php 
    require_once './config.php';
    


    $sql='SELECT * From timeoffrequests ORDER BY timeoffrequests.request_id DESC';
    $prep=$con->prepare($sql);
    $prep->execute();
    $requestDatas= $prep->fetchAll();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/request.css">
    <script type="text/javascript" src="js/index.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>HR Partner | Employee Portal</title>
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
        <button><a href="?page=newrequest"><i class="fa fa-plus"></i> Add Time Off/Leave Request</a></button>
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
                        <td><a class="info" href=""data-bs-toggle="modal" data-bs-target="#requestInfoModal" data-bs-whatever="@mdo"><i class="fa-solid fa-magnifying-glass"></i> info</a></td>
                        <?php if ($requestData['status'] == 'Submited'): ?>
                            <td><a href="" data-bs-toggle="modal" data-bs-target="#deleteRequestModal<?php echo $requestData['request_id']; ?>" data-bs-whatever="@mdo"class="delete"><i class="fa-solid fa-trash-can"></i> Delete request</a></td>
                        <?php endif; ?>
                        <!-- Modal -->
                        <div class="modal fade" id="requestInfoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="deleteRequestModal<?php echo $requestData['request_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    
                                    <div class="modal-body">
                                    <i class="fa-solid fa-circle-exclamation fa-2xl" style="color: #e53935"></i>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                            <a href="pages/deleteRequest.php?request_id=<?= $requestData['request_id']; ?>"
                                    class="delete"><i class="fa-solid fa-trash-can"></i> Delete request</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

    </div>
</div>
</html>