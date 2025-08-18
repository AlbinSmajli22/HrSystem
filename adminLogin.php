<?php
require_once 'config.php';
include_once 'adminloginlogic.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="css/login.css">
    <?php include_once 'template/header.php' ?>

</head>
<body>
    <div id="main">
        <div id="intro">
            <div id="foto">
                <img src="images/hrpartner.png" alt="">
            </div>
            <h2>MetDaan</h2>
            <h3>Employee Portal</h3>
            <p>Welcome. Please login login below.</p>
        </div>
        <form action="" method="POST">
        <p class="error"><?php echo $errors['wrongPass'] ?> <?php echo $errors['userNotExist'] ?></p>
            <input type="email" name="email" id="email" placeholder="Username">
            <input type="password" name="password" id="password"placeholder="Password">
            <button type="submit" name="submit">Login</button>

            <a href=""> <small>Forgot your password</small></a>
            <p Style="margin-bottom: 10px; margin-top: 20px;">
                <small>
                    Looking for the MetDaan employee portal? <br> <a href="index.php">Click here to sign on as an employee instead.</a>
                </small>
            </p>
            <p>
                <small>
                    © 2023 HR Partner Software Pty Ltd
                </small>
            </p>
        </form>
    </div>
</body>
</html>