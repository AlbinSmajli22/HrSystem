<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <script src="https://kit.fontawesome.com/3d560ffcbd.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>

    <div id="sidebar">
        <div id="profile">
            <img src="images/albin-smajli.png" alt="">
            <?php echo "<h2> ". $_SESSION['name'] . "</h2>"; ?>
        </div>
         <ul id="sidebarElements" >
            <li>
            <i class="fa-solid fa-house-chimney"></i>
            <a href="?page=page1">Home</a>
            </li>
            <li>
            <i class="fa-solid fa-user"></i>
            <a href="?page=page2">My Profile</a>
            </li>
            <li>
            <i class="fa-solid fa-list"></i>
            <a href="?page=page3">Directory</a>
            </li>
            <li>
            <i class="fa-solid fa-sitemap"></i>
            <a href="?page=page4">Org. Chart</a>
            </li>
            <li>
            <i class="fa-regular fa-calendar-days"></i>
            <a href="?page=page5">Calendar</a>
            </li>
            <li>
            <i class="fa fa-plane"></i>
            <a href="?page=page6">Time Off & Leave</a>
            </li>
            <li>
            <i class="fa fa-check-square-o"></i>
            <a href="?page=page7">Checklist</a>
            </li>
            <li>
            <i class="fa-solid fa-money-bill-1-wave"></i>
            <a href="?page=page8">Expenses</a>
            </li>
            <li>
            <i class="fa-solid fa-bullseye"></i>
            <a href="?page=page9">Goals</a>
            </li>
            <li>
            <i class="fa-solid fa-square-pen"></i>
            <a href="?page=page10">Forms</a>
            </li>
            <li>
            <i class="fa-solid fa-book"></i>
            <a href="?page=page11">Library</a>
            </li>
            <li>
            <i class="fa-solid fa-newspaper"></i>
            <a href="?page=page12">News</a>
            </li>
            <li>
            <i class="fa-solid fa-thumbtack"></i>
            <a href="?page=page13">Pinboard</a>
            </li>
            <li>
            <a href="logout.php">Log out</a>
            </li>
         </ul>
        
        
    </div>
    <div id="content">
   
        <?php
         if(!isset($_GET['page']) || $_GET['page'] == ''){
            $page = 'page1'; //If no page specified
        } else {
            $page = $_GET['page'];
        }
            switch ($page) {
                case 'page1':
                    include 'pages/home.php';
                    break;

                case 'page2':
                    include 'pages/about.php';
                    break;
                    
                default:
                     include 'pages/notfound.php';
            }
        ?>
    </div>
</body>
</html>