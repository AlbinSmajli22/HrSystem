<?php
require_once 'connection.php';
session_start();


$limit_page = 7;
$page = "";
if (isset($_POST['page_no'])) {
    $page = $_POST['page_no'];
} else {
    $page = 1;
}

$offset = ($page - 1) * $limit_page;



$userId = $_SESSION['user_id'];
if ($_SESSION['role'] == 0) {
    $sql = "SELECT * From timeoffrequests
 WHERE User_ID =$userId
 ORDER BY timeoffrequests.request_id DESC LIMIT  $offset, $limit_page";
    $prep = $con->prepare($sql);
    $prep->execute();
    $requestDatas = $prep->fetchAll();
} else if ($_SESSION['role'] == 1) {
    $sql = "SELECT * From timeoffrequests
 ORDER BY timeoffrequests.request_id DESC LIMIT $offset, $limit_page";
    $prep = $con->prepare($sql);
    $prep->execute();
    $requestDatas = $prep->fetchAll();
}

$output = "";
$row = count($requestDatas);




include_once 'GetLeadAndHR.php';


if ($row > 0) {
    $output .= '<table class="recentLeave">
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
       <tbody>';


    foreach ($requestDatas as $requestData) {
        $output .= "<tr>
       	<td>{$requestData['leave_type']}</td>
       	<td><ul>
           <li>
               {$requestData['short_description']}
           </li>
           <li>
               {$requestData['reason']}
           </li>
       </ul></td>
        <td>{$requestData['from']}</td>
       	<td>{$requestData['to']}</td>
       	<td>{$requestData['duration']}</td>
        <td>";
        if ($requestData['status'] == 'Submited') {

            $output .= "<span class='submited'>
                {$requestData['status']}
            </span>";

        } elseif ($requestData['status'] == 'Approved') {
            $output .= "
            <span class='approved'>
                {$requestData['status']}
            </span>";
        } else{
            $output .= "
            <span class='decline'>
                {$requestData['status']}
            </span>";
        }
        $output .= "</td>
        <td><a href='' data-bs-toggle='modal'
        data-bs-target='#requestInfoModal{$requestData['request_id']}'
        data-bs-whatever='@mdo' class='info'><i class='fa-solid fa-magnifying-glass'></i> info</a>
        </td>
        ";
        if ($requestData['status'] == 'Submited') {

            $output .= "
        <td><a href='' data-bs-toggle='modal'
        data-bs-target='#deleteRequestModal{$requestData['request_id']}'
        data-bs-whatever='@mdo' class='delete'><i class='fa-solid fa-trash-can'></i> Delete
        request</a>
        </td>";
        }
        $output .= "
                    
       </tr>";
    }
    $output .= "</tbody>
                    </table>";

    if ($_SESSION['role'] == 0) {
        $sql2 = "SELECT * From timeoffrequests
                     WHERE User_ID =$userId
                     ORDER BY timeoffrequests.request_id DESC";
        $prep = $con->prepare($sql2);
        $prep->execute();
        $requestDatas2 = $prep->fetchAll();
    } else if ($_SESSION['role'] == 1) {
        $sql2 = "SELECT * From timeoffrequests
                     ORDER BY timeoffrequests.request_id DESC";
        $prep = $con->prepare($sql2);
        $prep->execute();
        $requestDatas2 = $prep->fetchAll();
    }
    $row = count($requestDatas2);
    $total_page = ceil($row / $limit_page);
    $output .= '<ul class="pagination">';
    for ($i = 1; $i <= $total_page; $i++) {
        if ($i == $page) {
            $active = "active";
        } else {
            $active = "";
        }
        $output .= "<li class='{$active}'><a id='{$i}'>{$i}</a></li>";
    }
    $output .= '</ul>';

    echo $output;
}

?>