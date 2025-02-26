<?php
require_once 'config.php';
session_start();

$errors = array('userNotExist' => '', 'wrongPass' => '');
if (isset($_POST['submit'])) {
    

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql="SELECT * FROM users
          LEFT JOIN position ON users.Position_ID = position.position_id
          LEFT JOIN departament ON users.Departament_ID = departament.departament_id
          LEFT JOIN company ON users.company=company.company_id
          WHERE email=:email";

    $prep= $con->prepare($sql);

    $prep->bindParam(':email', $email);
    $prep->execute();
    $data= $prep->fetch();

    if ($data == false) {
        $errors['userNotExist'] = 'Sorry, we cannot find that account here. Please check your username is correct or contact an admin user for assistance.';

    }
    elseif (password_verify($password, $data['password'])) {
        $sql="SELECT * FROM users";
        $prep= $con->prepare($sql);
        $prep->execute();
        $data2= $prep->fetch();

        $_SESSION['company'] = $data['company'];
        $_SESSION['company_name'] = $data['company_name'];
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['password'] = $data['password'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['position'] = $data['position_name'];
        $_SESSION['departament'] = $data['departament_name'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['name'] = $data['name'] . " " . $data['surname'];
        $_SESSION['location'] = $data['location'];
        $_SESSION['report_to'] = $data['report_to'];
        $_SESSION['status'] = $data['status'];
        $_SESSION['gender'] = $data['gender'];
        $_SESSION['born'] = $data['born'];
        $_SESSION['started'] = $data['started'];
        $_SESSION['HR'] = $data2['name'] . " " . $data2['surname'];
        
        header("Location: pages/home.php");
    } elseif (!password_verify($password, $data['password'])) {
        $errors['wrongPass'] = 'Sorry, your username and/or password is incorrect. Please try again.';

    } else {
        $errors['userNotExist'] = 'Sorry, we cannot find that account here. Please check your username is correct or contact an admin user for assistance.';
  
    }


}

?>