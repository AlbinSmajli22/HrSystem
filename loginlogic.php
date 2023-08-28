<?php
require_once 'config.php';
session_start();

if (isset($_POST['submit'])) {
    

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql="SELECT * FROM users WHERE email=:email";

    $prep= $con->prepare($sql);

    $prep->bindParam(':email', $email);
    $prep->execute();
    $data= $prep->fetch();

    if ($data == false) {
        echo "user does not exist";
    }
    elseif (password_verify($password, $data['password'])) {
        $_SESSION['email']=$data['email'];
        $_SESSION['role']=$data['role'];
        $_SESSION['name']=$data['name']." ".$data['surname'];

        header("Location: main.php");  
    }
    elseif(!password_verify($password, $data['password'])){
        echo 'Password is Wrong.';
    }else
    {
        echo"user does not exist";
    }


}

?>