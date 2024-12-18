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
        <?php if ($_SESSION['role'] == 0) { ?>
            <li class="dropdown" Style="cursor: pointer;">
                <i class="fa fa-plane"></i>
                <a onclick="myFunction()" class="dropbtn">Time Off & Leave <i class="fa-solid fa-caret-right"></i></a>
                <div id="myDropdown" class="dropdown-content">
                    <a href="request.php"><i class="fa-solid fa-suitcase"></i> Request</a>
                    <a href="approverequest.php"> <i class="fa fa-calendar-check-o"></i> Approve</a>
                    <a href="requesthistory.php"><i class="fa fa-list"></i> History</a>
                </div>
            </li>
        <?php } else { ?>
            <li class="dropdown" Style="cursor: pointer;">
                <i class="fa fa-plane"></i>
                <a onclick="myFunction()" class="dropbtn">Time Off & Leave <i class="fa-solid fa-caret-right"></i></a>
                <div id="myDropdown" class="dropdown-content">
                    <a href="planer.php"><i class="fa-regular fa-calendar-days"></i> Planer</a>
                    <a href="approverequest.php"> <i class="fa fa-plane"></i> Requests</a>
                    <a href="availability.php"><i class="fa-solid fa-rectangle-list"></i> Availability</a>
                    <a onclick="myFunctionTwo()" class="Leavebtn"><i class="fa-solid fa-pencil"></i> Bulk Update <i
                            class="fa-solid fa-caret-right"></i></a>
                    <a href="configureLeaves.php"><i class="fa-solid fa-gear"></i> Configure</a>
                    <div id="leaveConfigure" class="leave-dropdown-content">
                        <a href="balances.php"> <i class="fa-solid fa-calculator"></i> Balances</a>
                        <a href="allowance.php"><i class="fa-solid fa-hourglass-half"></i> Allowances</a>
                    </div>

                </div>
            </li>
        <?php } ?>
        <?php if ($_SESSION['role'] == 0) { ?>
            <li class="dropdown" Style="cursor: pointer;">
                <i class="fa-solid fa-money-bill-1-wave"></i>
                <a href="empexpenses.php">Expenses</a>
            </li>
        <?php } else { ?>
            <li class="dropdown" Style="cursor: pointer;">
                <i class="fa-solid fa-money-bill-1-wave"></i>
                <a onclick="myFunctionThree()" class="excbtn">Expenses <i class="fa-solid fa-caret-right"></i></a>
                <div id="expensesConfigure" class="exceptions-dropdown-content">
                    <a href="expenses.php"><i class="fa-regular fa-square-check"></i> Expenses</a>
                    <a href="configureExpenses.php"> <i class="fa-solid fa-gear"></i> Configure</a>
                </div>
            </li>
        <?php } ?>
        <?php if ($_SESSION['role'] == 0) { ?>
            <li>
                <i class="fa-solid fa-bullseye"></i>
                <a href="goals.php">Goals</a>
            </li>
        <?php } else { ?>
            <li class="dropdown" Style="cursor: pointer;">
                <i class="fa-solid fa-bullseye"></i>
                <a onclick="myFunctionFour()" class="goalbtn">Goals <i class="fa-solid fa-caret-right"></i></a>
                <div id="goalsConfigure" class="goals-dropdown-content">
                    <a href="assignesGoals.php"><i class="fa-regular fa-square-check"></i> Assigned</a>
                    <a href="configureExpenses.php"> <i class="fa-solid fa-gear"></i> Configure</a>
                </div>
            </li>

        <?php } ?>
        <li>
            <i class="fa-solid fa-book"></i>
            <a href="library.php">Library</a>
        </li>
        <li>
            <i class="fa-solid fa-newspaper"></i>
            <?php if ($_SESSION['role'] == 0) { ?>
                <a href="empNews.php">News</a>
            <?php } else { ?>
                <a href="news.php">News</a>
            <?php } ?>
        </li>
        <li>
            <i class="fa-solid fa-thumbtack"></i>
            <a href="pinboard.php">Pinboard</a>
        </li>
    </ul>


</div>