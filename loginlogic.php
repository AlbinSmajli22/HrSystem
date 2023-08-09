<?php
require_once 'config.php';

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
        $_SESSION['name']=$data['name'];

        header("Location: index.php");  
    }
    else{
        echo 'Woops! fullname or Password is Wrong.';
    }


}

?>