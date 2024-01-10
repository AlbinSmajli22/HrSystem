
<?php 
//include_once '../config.php';

if (isset($_POST['edit'])) {
    $user_id = $_POST['user_id'];
    $name= $_POST['name'];
    $surname= $_POST['surname'];
    $email= $_POST['email'];
    $Position_ID= $_POST['Position_ID'];
    $Departament_ID= $_POST['Departament_ID'];
    $role= $_POST['role'];
    $location= $_POST['location'];
    $status= $_POST['status'];
    $report_to = $_POST['report_to'];
    $gender= $_POST['gender'];
    //$born= $_POST['born']->date_format("y-m-d");
    //$started = $_POST['started']->date_format("y-m-d");
    $temPass = $_POST['password'];
    $password = password_hash($temPass, PASSWORD_DEFAULT);


	$sql = "UPDATE users SET user_id=:user_id, name=:name, surname=:surname, email=:email, Position_ID=:Position_ID, Departament_ID=:Departament_ID, role=:role,  location=:location, status=:status, password=:password, 
            report_to=:report_to, gender=:gender WHERE user_id =:user_id ";



    $prep = $con->prepare($sql);

    $prep->bindParam("user_id", $user_id);
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
    //$prep->bindParam(':born', $born);
    //$prep->bindParam(':started', $started);

    
    $prep->execute();



}
?>