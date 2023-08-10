<?php
require_once 'config.php';
include_once 'loginlogic.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Document</title>
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
        <form action="loginlogic.php" method="POST">
            <input type="email" name="email" id="email" placeholder="Username">
            <input type="password" name="password" id="password"placeholder="Password">
            <button type="submit" name="submit">Login</button>

            <a href=""> <small>Forgot your password</small></a>
            <p Style="margin-bottom: 10px; margin-top: 20px;">
                <small>
                    Note: This login is for employees only.
                    <br>
                    Admin users please use the <a href="">admin login form.</a>
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