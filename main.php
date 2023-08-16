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
         <ul id="sidebarElements" >
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
            <li>
            <i class="fa fa-plane"></i>
            <a href="?page=timeOff">Time Off & Leave</a>
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
            <li>
            <a href="logout.php">Log out</a>
            </li>
         </ul>
        
        
    </div>
    <div id="content">
   
        <?php
         if(!isset($_GET['page']) || $_GET['page'] == ''){
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
                    default:
                     include 'pages/notfound.php';
            }
        ?>
    </div>
</body>
</html>