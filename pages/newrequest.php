<?php
include_once 'timeOffRequest.php';

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
            <img src="images/request_leave5.png" alt="" width="40px" height="40px">
            Request Time Off/Leave
        </h2>
        <div id="space-div"></div>
        <form action="" method="POST">
            <div class="row">
                <span></span>
                <span></span>
            </div>
            <div class="row">
                <select name="LeaveType" id="LeaveType">
                    <option value="annual_leave">Annual Leave</option>
                    <option value="Child Born">Child Born</option>
                    <option value="Death of Family Member">Death of Family Member</option>
                    <option value="Moving Day">Moving Day</option>
                    <option value="Wedding Day">Wedding Day</option>
                    <option value="Sick Leave">Sick Leave</option>
                </select>
            </div>
            <div class="row">
                <input type="date" name="from" id="from" onchange="cal()">
                <input type="date" name="to" id="to" onchange="cal()">
                <input type="number" name="duration" id="duration" onclick="durationFunction()">
            </div>
            <div class="row">
                <input type="text" name="shortDescription" id="shortDescription">
            </div>
            <div class="row">
                <input type="text" name="reason" id="reason">
                <input type="hidden" name="status" id="status" value="Submited">
            </div>
            <div class="row">
                <button name="enter" type="submit">Submit</button>
            </div>
        </form>
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