
<?php 
include_once '../config.php';

if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
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

	$sql = "UPDATE users SET name=:name, surname=:surname, email=:email, password=:password, Position_ID=:Position_ID, Departament_ID=:Departament_ID, role=:role, location=:location, status=:status WHERE user_id=:user_id";



    $prep = $con->prepare($sql);

    $prep->bindParam(":user_id", $user_id);
    $prep->bindParam(':name', $name);
    $prep->bindParam(':surname', $surname);
    $prep->bindParam(':email', $email);
    $prep->bindParam(':password', $password);
    $prep->bindParam(':Position_ID', $Position_ID);
    $prep->bindParam(':Departament_ID', $Departament_ID);
    $prep->bindParam(':role', $role);
    $prep->bindParam(':location', $location);
    $prep->bindParam(':status', $status);
   
    $prep->execute();

    header("Location: ../main.php?page=directory");

}
?>