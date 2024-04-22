<?php
require_once './config.php';
/*
$userId = $_SESSION['user_id'];
if ($_SESSION['role'] == 0) {
    $sql = "SELECT * From timeoffrequests
 WHERE User_ID =$userId
 ORDER BY timeoffrequests.request_id DESC";
    $prep = $con->prepare($sql);
    $prep->execute();
    $requestDatas = $prep->fetchAll();
} else if ($_SESSION['role'] == 1) {
    $sql = "SELECT * From timeoffrequests
 ORDER BY timeoffrequests.request_id DESC";
    $prep = $con->prepare($sql);
    $prep->execute();
    $requestDatas = $prep->fetchAll();
}

*/
?>

<?php
include_once 'GetLeadAndHR.php';
?>



<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"/>  
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/request.css">
    <script type="text/javascript" src="js/index.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
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
      
        <div>
           
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
   showdata();
 }); 
function showdata(page)
{
  $.ajax({
      url: 'pages/requestPagination.php',
      method: 'post',
      data: {page_no:page},
      success: function(result)
      {
        $(".requestTableBody").html(result);
      }
    });
}
$(document).on("click",".pagination a", function(){
var page = $(this).attr('id');
showdata(page);
});
</script>

</html>