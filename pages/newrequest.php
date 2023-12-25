<?php

include_once 'createRequest.php';

?>
<body>
    <h3>request</h3>


    <form action="" method="POST">
    <input type="hidden" value="<?=$_SESSION['user_id']?>" name="user_id">
    <input type="hidden" value="<?=$_SESSION['report_to']?>"name="head_id">
    <select name="LeaveType" id="LeaveType">
        <option value="annual_leave">Annual Leave</option>
        <option value="Child Born">Child Born</option>
        <option value="Death of Family Member">Death of Family Member</option>
        <option value="Moving Day">Moving Day</option>
        <option value="Wedding Day">Wedding Day</option>
        <option value="Sick Leave">Sick Leave</option>
    </select>
    <input type="date" name="from" id="from">
    <input type="date" name="to" id="to">
    <input type="number" name="duration" id="duration">
    <input type="text" name="shortDescription" id="shortDescription">
    <textarea name="reason" id="reason" cols="30" rows="10"></textarea>


    <button name="submit" type="submit">Submit</button>
    </form>
</body>
</html> 