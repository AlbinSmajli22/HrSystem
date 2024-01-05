<?php
include_once 'timeOffRequest.php';

?>
<body>
    <h3>request</h3>


    <form action="" method="POST">  
    <select name="LeaveType" id="LeaveType">
        <option value="annual_leave">Annual Leave</option>
        <option value="Child Born">Child Born</option>
        <option value="Death of Family Member">Death of Family Member</option>
        <option value="Moving Day">Moving Day</option>
        <option value="Wedding Day">Wedding Day</option>
        <option value="Sick Leave">Sick Leave</option>
    </select>
    <input type="date" name="from" id="from" onchange="cal()">
    <input type="date" name="to" id="to" onchange="cal()">
    <input type="number" name="duration" id="duration" onclick="durationFunction()">
    <input type="text" name="shortDescription" id="shortDescription">
    <input type="text" name="reason" id="reason">
    <input type="hidden" name="status" id="status" value="Submited">


    <button name="enter" type="submit">Submit</button>
    </form>
</body>
</html> 
<script type="text/javascript">

function GetDays(){
                var to = new Date(document.getElementById("to").value);
                var from = new Date(document.getElementById("from").value);
                return parseInt((to - from) / (24 * 3600 * 1000));
        }

        function cal(){
        if(document.getElementById("to")){
            document.getElementById("duration").value=GetDays();
        }  
    }

</script>