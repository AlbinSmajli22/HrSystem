<?php
require_once 'config.php';
session_start();

if (isset($_POST['submit'])) {
    

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql="SELECT * FROM users
          LEFT JOIN position ON users.Position_ID = position.position_id
          LEFT JOIN departament ON users.Departament_ID = departament.departament_id 
          WHERE email=:email";

    $prep= $con->prepare($sql);

    $prep->bindParam(':email', $email);
    $prep->execute();
    $data= $prep->fetch();

    if ($data == false) {
        echo "user does not exist";
    }
    elseif (password_verify($password, $data['password'])) {
        $_SESSION['user_id']=$data['user_id'];
        $_SESSION['email']=$data['email'];
        $_SESSION['position']=$data['position_name'];
        $_SESSION['departament']=$data['departament_name'];
        $_SESSION['role']=$data['role'];
        $_SESSION['name']=$data['name']." ".$data['surname'];
        $_SESSION['location']=$data['location'];
        $_SESSION['report_to']=$data['report_to'];
        $_SESSION['status']=$data['status'];
        $_SESSION['gender']=$data['gender'];
        $_SESSION['born']=$data['born'];
        $_SESSION['started']=$data['started'];
        

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