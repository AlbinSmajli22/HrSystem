<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Document</title>
</head>
<body>

    <div id="sidebar">
        <div id="profile">
            <img src="images/person.png" alt="">
            <h3>Albin Smajli</h3>
        </div>

        <a href="?page=page1">HOME</a>
        <a href="?page=page2">ABOUT</a>
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