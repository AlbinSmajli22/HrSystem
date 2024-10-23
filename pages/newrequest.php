<?php
require_once '../config.php';
session_start();
include_once 'timeOffRequest.php';

include_once 'GetLeadAndHR.php';


$companyId = $_SESSION['company'];

$timeoffQuery = "SELECT * FROM timeofftype LEFT JOIN amountoftimeoff ON timeofftype.id = amountoftimeoff.time_off_type
    where company_id=$companyId and user_id=$userId
    ORDER BY timeofftype.time_off ASC";

$prep = $con->prepare($timeoffQuery);
$prep->execute();
$timeoffs = $prep->fetchAll();

?>

<head>
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
    <link rel="stylesheet" href="../css/newRequest.css">
</head>

<body>
    <div>
        <?php include '../template/sidebar.php' ?>
    </div>
    <div id="request-container">
        <?php include '../template/navbar.php' ?>
        <div id="company-Name">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>
        <div id="request-Content">
            <h2>
                <img src="../images/request_leave5.png" alt="" width="50px" height="50px">
                Request Time Off/Leave
            </h2>
            <div id="space-div"></div>
            <form action="" method="POST">
                <div class="row">
                    <div id="rowLH">
                        <label for="">Application Will Be Sent To:</label>
                        <p>
                            <span>
                                <?= $leaderName ?>
                                <?= $leaderSurname ?>*
                            </span>
                            and
                            <span>
                                <?= $HR ?>
                            </span>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div id="rowLeaveType">
                        <label for="LeaveType">Leave Type *</label>
                        <select name="LeaveType" id="LeaveType">
                            <option value="Annual Leave">Annual Leave</option>
                            <option value="Child Born">Child Born</option>
                            <option value="Death of Family Member">Death of Family Member</option>
                            <option value="Moving Day">Moving Day</option>
                            <option value="Wedding Day">Wedding Day</option>
                            <option value="Sick Leave">Sick Leave</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="row2">
                        <label for="from">from *</label>
                        <input type="date" name="from" id="from" onchange="cal()">
                        <!-- <p id="daysMessange">You will have an estimated <Strong>5 hours 19 minutes</Strong> of <em>Annual Leave</em> on this date.</p> -->
                    </div>
                    <div class="row2">
                        <label for="to">Until *</label>
                        <input type="date" name="to" id="to" onchange="cal()">
                    </div>
                    <div class="row2">
                        <label for="duration">Duration(Days) *</label>
                        <input type="number" name="duration" id="duration" onclick="durationFunction()">
                        <!-- <p id="errorMSG" Style=" color:#CC5965; font-weight:700;" >Sorry, you do not have enough leave - your balance is currently 2 days 2 hours 39 minutes</p> -->
                        <p Style="color:#737373;">Enter days (or partial days as a decimal, or click the calculator icon
                            to specify)</p>
                    </div>
                </div>
                <div class="rowShortDescription">
                    <div id="rowShortDescription2">
                        <label for="shortDescription">Short Description * </label>
                        <input type="text" name="shortDescription" id="shortDescription">
                    </div>
                </div>
                <div class="rowReason">
                    <div id="rowReason2">
                        <label for="reason">Reason </label>
                        <input type="text" name="reason" id="reason">
                        <input type="hidden" name="status" id="status" value="Submited">
                    </div>
                </div>
                <div id="btn-row">
                    <button name="enter" type="submit">Submit</button>
                    <button name="cancel" type="submit">Cancel</button>
                </div>
            </form>
            <div id="space-div2"></div>
        </div>
        <div id="balance-calendar">
            <div class="timeOff">
                <div class="timeOffHead">
                    <h5>
                        <img src="../images/balance.png" alt="" height="24px" width="24px">
                        Time Off/Leave Balances
                    </h5>
                </div>
                <div class="timeOffBody">
                    <table class="leavs">
                        <thead>
                            <tr>
                                <td><Strong>Time Off/Leave Type</Strong></td>
                                <td><Strong>Allowance</Strong> <br><small> (Annual)</small></td>
                                <td><Strong>Balance</Strong> <br> <small> (Accrued)</small></td>
                                <td><Strong>Planned</Strong> <br><small> (In the future)</small></td>
                                <td><Strong>Available </Strong><br><small> (To take) </small></td>
                                <td><Strong>Units</Strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($timeoffs as $timeoff): ?>
                                <tr>
                                    <td class="leavType"><?= $timeoff['time_off'] ?> </td>
                                    <td><?= $timeoff['allowance'] ?></td>
                                    <td><?= $timeoff['balance'] ?></td>
                                    <td><?= $timeoff['planned'] ?></td>
                                    <td><?= $timeoff['available'] ?></td>
                                    <td>Days</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include '../template/footer.php'; ?>
    </div>
</body>
<script type="text/javascript">

    function GetDays() {
        var to = new Date(document.getElementById("to").value);
        var from = new Date(document.getElementById("from").value);
        return parseInt((to - from) / (24 * 3600 * 1000));
    }

    function cal() {
        if (document.getElementById("to")) {
            document.getElementById("duration").value = GetDays();
        }
    }


</script>