<?php
require_once 'config.php';
session_start();

$errors = array('userNotExist' => '', 'wrongPass' => '');
if (isset($_POST['submit'])) {
    

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql="SELECT * FROM admins
          LEFT JOIN company ON admins.company_id=company.company_id
          WHERE email=:email";

    $prep= $con->prepare($sql);

    $prep->bindParam(':email', $email);
    $prep->execute();
    $data= $prep->fetch();

    if ($data == false) {
        $errors['userNotExist'] = 'Sorry, we cannot find that account here. Please check your username is correct or contact an admin user for assistance.';

    }
    elseif (password_verify($password, $data['password'])) {
        $sql="SELECT * FROM admins";
        $prep= $con->prepare($sql);
        $prep->execute();
        $data2= $prep->fetch();

        $_SESSION['company'] = $data['company'];
        $_SESSION['company_name'] = $data['company_name'];
        $_SESSION['password'] = $data['password'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['name'] = $data['name'] . " " . $data['surname'];

        
        header("Location: pages/adminHome.php");
    } elseif (!password_verify($password, $data['password'])) {
        $errors['wrongPass'] = 'Sorry, your username and/or password is incorrect. Please try again.';

    } else {
        $errors['userNotExist'] = 'Sorry, we cannot find that account here. Please check your username is correct or contact an admin user for assistance.';
  
    }


}

?>