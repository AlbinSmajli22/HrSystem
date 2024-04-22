<?php
session_start();
$userId = $_SESSION['user_id'];
require_once 'connection.php';


$limit_page = 7;
$page="";
if(isset($_POST['page_no']))
{
       $page = $_POST['page_no'];
}
else
{
       $page = 1;
}

$offset = ($page-1)* $limit_page;



$userId = $_SESSION['user_id'];
 $sql = "SELECT * From timeoffrequests 
 WHERE User_ID =$userId
 ORDER BY timeoffrequests.request_id DESC
 LIMIT $offset, $limit_page";
    $prep = $con->prepare($sql);
    $prep->execute();
    $requestDatas = $prep->fetchAll();

$output="";
$row = count($requestDatas);

if($row>0)
{
       $output .='<table id="historyTable">
    <thead >
      <th>Leave Type</th>
      <th>Short Description</th>
      <th>Reason</th>
      <th>From</th>
      <th>To</th>
      <th>Duration</th>
      <th>Status</th>
      </thead>';
    
   
	foreach($requestDatas as $res)
	{
       $output .="<tr>
       	<td>{$res['leave_type']}</td>
       	<td>{$res['short_description']}</td>
       	<td>{$res['reason']}</td>
              <td>{$res['from']}</td>
       	<td>{$res['to']}</td>
       	<td>{$res['duration']}</td>
       	<td>{$res['status']}</td>
       	
       </tr>";
       }
       $output .="</table>";

       $sql2 = "SELECT * From timeoffrequests  WHERE User_ID =$userId";
          $prep = $con->prepare($sql2);
          $prep->execute();
          $requestDatas2 = $prep->fetchAll();
$row = count($requestDatas2);
$total_page = ceil($row/$limit_page);
       $output .='<ul class="pagination">';
for($i=1; $i<=$total_page; $i++)
{
       if($i==$page)
       {
              $active ="active";
       }
       else
       {
              $active = "";
       }
   $output .= "<li class='{$active}'><a id='{$i}'>{$i}</a></li>";
}  
  $output .='</ul>';

  echo $output;
}
?>