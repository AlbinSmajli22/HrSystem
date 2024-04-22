<?php
/*
$userId = $_SESSION['user_id'];
 $sql = "SELECT * From timeoffrequests
 WHERE User_ID =$userId
 ORDER BY timeoffrequests.request_id DESC";
    $prep = $con->prepare($sql);
    $prep->execute();
    $requestDatas = $prep->fetchAll();



*/
?>
<head>
<title>AJAX Pagination</title>  
<link rel="stylesheet" href="css/requsetHistory.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"/>  
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>  
    <div class="container">  
    <br/>
    <div id="result">
    </div>
  </div>
</body>  
<script type="text/javascript">
$(document).ready(function(){
   showdata();
 }); 
function showdata(page)
{
  $.ajax({
      url: 'pages/requesthistoryPagination.php',
      method: 'post',
      data: {page_no:page},
      success: function(result)
      {
        $("#result").html(result);
      }
    });
}
$(document).on("click",".pagination a", function(){
var page = $(this).attr('id');
showdata(page);
});
</script>
