<?php
require_once 'config.php';
session_start();

?>

<head>
    <?php include_once 'template/header.php' ?>
</head>

<body>

    <div id="sidebar">
        <div id="profile">
            <img src="images/albin-smajli.png" alt="">
            <?php echo "<h3>" . $_SESSION['name'] . "</h3>"; ?>
        </div>
        <ul id="sidebarElements">
            <li>
                <i class="fa-solid fa-house-chimney"></i>
                <a href="?page=home">Home</a>
            </li>
            <li>
                <i class="fa-solid fa-user"></i>
                <a href="?page=myProfile">My Profile</a>
            </li>
            <li>
                <i class="fa-solid fa-list"></i>
                <a href="?page=directory">Directory</a>
            </li>
            <li>
                <i class="fa-solid fa-sitemap"></i>
                <a href="?page=orgChart">Org. Chart</a>
            </li>
            <li>
                <i class="fa-regular fa-calendar-days"></i>
                <a href="?page=calendar">Calendar</a>
            </li>
            <li class="dropdown"Style="cursor: pointer;">
                <i class="fa fa-plane"></i>
                <a onclick="myFunction()" class="dropbtn" >Time Off & Leave</a>
                <div id="myDropdown" class="dropdown-content">
                    <a href="?page=request"><i class="fa-solid fa-suitcase"></i> Request</a>
                    <a href="?page=approverequest"> <i class="fa fa-calendar-check-o"></i> Approve</a>
                    <a href="?page=requesthistory"><i class="fa fa-list"></i> History</a>
                </div>
            </li>
            <li>
                <i class="fa fa-check-square-o"></i>
                <a href="?page=checklist">Checklist</a>
            </li>
            <li>
                <i class="fa-solid fa-money-bill-1-wave"></i>
                <a href="?page=expenses">Expenses</a>
            </li>
            <li>
                <i class="fa-solid fa-bullseye"></i>
                <a href="?page=goals">Goals</a>
            </li>
            <li>
                <i class="fa-solid fa-square-pen"></i>
                <a href="?page=forms">Forms</a>
            </li>
            <li>
                <i class="fa-solid fa-book"></i>
                <a href="?page=library">Library</a>
            </li>
            <li>
                <i class="fa-solid fa-newspaper"></i>
                <a href="?page=news">News</a>
            </li>
            <li>
                <i class="fa-solid fa-thumbtack"></i>
                <a href="?page=pinboard">Pinboard</a>
            </li>
        </ul>


    </div>
    <div id="content">
        <?php include './template/navbar.php' ?>
        <?php
        if (!isset($_GET['page']) || $_GET['page'] == '') {
            $page = 'home'; //If no page specified
        } else {
            $page = $_GET['page'];
        }
        switch ($page) {
            case 'home':
                include 'pages/home.php';
                break;

            case 'myProfile':
                include 'pages/myProfile.php';
                break;

            case 'directory':
                include 'pages/directory.php';
                break;

            case 'orgChart':
                include 'pages/orgChart.php';
                break;

            case 'calendar':
                include 'pages/calendar.php';
                break;

            case 'timeOff':
                include 'pages/timeOff.php';
                break;
            case 'checklist':
                include 'pages/checklist.php';
                break;
            case 'expenses':
                include 'pages/expenses.php';
                break;
            case 'goals':
                include 'pages/goals.php';
                break;
            case 'forms':
                include 'pages/forms.php';
                break;
            case 'library':
                include 'pages/library.php';
                break;
            case 'news':
                include 'pages/news.php';
                break;
            case 'pinboard':
                include 'pages/pinboard.php';
                break;
            case 'request':
                include 'pages/request.php';
                break;                
            case 'newrequest':
                include 'pages/newrequest.php';
                break;                
            case 'approve':
                include 'pages/approverequest.php';
                break;                
            case 'history':
                include 'pages/requesthistory.php';
                break;                
            default:
                include 'pages/notfound.php';
        }
        ?>
        <?php include_once 'template/footer.php' ?>
    </div>

</body>

</html>