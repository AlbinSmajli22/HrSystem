<?php
include_once 'timeOffRequest.php';

include_once 'GetLeadAndHR.php';

?>

<head>
    <link rel="stylesheet" href="css/newRequest.css">
</head>
<div id="request-container">
    <div id="company-Name">
        <h2>MetDaan</h2>
    </div>
    <div id="request-Content">
        <h2>
            <img src="images/request_leave5.png" alt="" width="50px" height="50px">
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
                    <span >
                        <?= $HR ?>
                    </span>
                </p>
                </div>
            </div>
            <div class="row">
                <div id="rowLeaveType">
                    <label for="LeaveType">Leave Type *</label>
                    <select name="LeaveType" id="LeaveType">
                        <option value="annual_leave">Annual Leave</option>
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
                    <p>You will have an estimated <Strong>5 hours 19 minutes</Strong> of <em>Annual Leave</em> on this date.</p>
                </div>
                <div class="row2">
                    <label for="to">Until *</label>
                    <input type="date" name="to" id="to" onchange="cal()">
                </div>
                <div class="row2">
                    <label for="duration">Duration(Days) *</label>
                    <input type="number" name="duration" id="duration" onclick="durationFunction()">
                    <p Style="color:#737373;">Enter days (or partial days as a decimal, or click the calculator icon to specify)</p>
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
            <div id="btm-row">
                <button name="enter" type="submit">Submit</button>
                <button name="cancel" type="submit">Cancel</button>
            </div>
        </form>
        <div id="space-div2"></div>
    </div>
</div>

</html>
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