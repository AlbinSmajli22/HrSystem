<?php

include_once 'config.php';


if (isset($_POST['submit'])) {
    
    $name= $_POST['name'];
    $surname= $_POST['surname'];
    $email= $_POST['email'];
    $Position_ID= $_POST['Position_ID'];
    $Departament_ID= $_POST['Departament_ID'];
    $role= $_POST['role'];
    $location= $_POST['location'];
    $status= $_POST['status'];
    $temPass = $_POST['password'];
    $password = password_hash($temPass, PASSWORD_DEFAULT);
    $report_to = $_POST['report_to'];
    $gender= $_POST['gender'];
    $born= $_POST['born'];
    $started = $_POST['started'];


    $sql = "INSERT INTO users (name, surname, email, password, Position_ID, Departament_ID, role, location, status, report_to, gender, born, started) VALUES (:name, :surname, :email, :password,:Position_ID,:Departament_ID,:role, :location, :status, :report_to, :gender, :born, :started)";

    $prep = $con->prepare($sql);

    $prep->bindParam(':name', $name);
    $prep->bindParam(':surname', $surname);
    $prep->bindParam(':email', $email);
    $prep->bindParam(':password', $password);
    $prep->bindParam(':Position_ID', $Position_ID);
    $prep->bindParam(':Departament_ID', $Departament_ID);
    $prep->bindParam(':role', $role);
    $prep->bindParam(':location', $location);
    $prep->bindParam(':status', $status);
    $prep->bindParam(':report_to', $report_to);
    $prep->bindParam(':gender', $gender);
    $prep->bindParam(':born', $born);
    $prep->bindParam(':started', $started);
   
    $prep->execute();
    
    Header("Location:pages/directory.php");
}

?>