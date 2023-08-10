<?php

include_once 'config.php';


if (isset($_POST['submit'])) {
    
    $name= $_POST['name'];
    $surname= $_POST['surname'];
    $email= $_POST['email'];
    $role= $_POST['role'];
    $position= $_POST['position'];
    $temPass = $_POST['password'];
    $password = password_hash($temPass, PASSWORD_DEFAULT);


    $sql = "INSERT INTO users (name, surname, email, password, role, position) VALUES (:name, :surname, :email, :password,:role, :position)";

    $prep = $con->prepare($sql);

    $prep->bindParam(':name', $name);
    $prep->bindParam(':surname', $surname);
    $prep->bindParam(':email', $email);
    $prep->bindParam(':password', $password);
    $prep->bindParam(':role', $role);
    $prep->bindParam(':position', $position);
    $prep->execute();
    
    Header("Location:index.php");
}

?>