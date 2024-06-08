<?php

$sql = "SELECT u.user_id, u.image from users u where user_id=$userId";

$prep = $con->prepare($sql);
$prep->execute();
$userImages = $prep->fetchAll();

?>

<head>
    <link rel="stylesheet" href="../css/index.css">
    <script src="../js/index.js"></script>
</head>
<div id="sidebar">
    <div id="profile">
        <?php foreach ($userImages as $userImage): ?>
            <img src="../userIMG/<?= $userImage['image'] ?>" alt="">
        <?php endforeach; ?>
        <?php echo "<h3>" . $_SESSION['name'] . "</h3>"; ?>
    </div>
    <ul id="sidebarElements">
        <li>
            <i class="fa-solid fa-house-chimney"></i>
            <a href="home.php">Home</a>
        </li>
        <li>
            <i class="fa-solid fa-user"></i>
            <a href="myProfile.php">My Profile</a>
        </li>
        <li>
            <i class="fa-solid fa-list"></i>
            <a href="directory.php">Directory</a>
        </li>
        <li>
            <i class="fa-solid fa-sitemap"></i>
            <a href="orgChart.php">Org. Chart</a>
        </li>
        <li>
            <i class="fa-regular fa-calendar-days"></i>
            <a href="calendar.php">Calendar</a>
        </li>
        <li class="dropdown" Style="cursor: pointer;">
            <i class="fa fa-plane"></i>
            <a onclick="myFunction()" class="dropbtn">Time Off & Leave</a>
            <div id="myDropdown" class="dropdown-content">
                <a href="request.php"><i class="fa-solid fa-suitcase"></i> Request</a>
                <a href="approverequest.php"> <i class="fa fa-calendar-check-o"></i> Approve</a>
                <a href="requesthistory.php"><i class="fa fa-list"></i> History</a>
            </div>
        </li>
        <li>
            <i class="fa fa-check-square-o"></i>
            <a href="pages/checklist.php">Checklist</a>
        </li>
        <li>
            <i class="fa-solid fa-money-bill-1-wave"></i>
            <a href="pages/expenses.php">Expenses</a>
        </li>
        <li>
            <i class="fa-solid fa-bullseye"></i>
            <a href="pages/goals.php">Goals</a>
        </li>
        <li>
            <i class="fa-solid fa-square-pen"></i>
            <a href="pages/forms.php">Forms</a>
        </li>
        <li>
            <i class="fa-solid fa-book"></i>
            <a href="pages/library.php">Library</a>
        </li>
        <li>
            <i class="fa-solid fa-newspaper"></i>
            <a href="'pages/news.php">News</a>
        </li>
        <li>
            <i class="fa-solid fa-thumbtack"></i>
            <a href="pages/pinboard.php">Pinboard</a>
        </li>
    </ul>


</div>