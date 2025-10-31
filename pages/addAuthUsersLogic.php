<?php
$userId = $_SESSION['user_id'];
$company_Id = $_SESSION['company'];

if (isset($_POST['addAuthUser'])) {

    $name = $_POST['firsName'] ?? '';
    $surname = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ?? '';
    $temPass = '123456';
    $password = password_hash($temPass, PASSWORD_DEFAULT);
    $existEmp = $_POST['existEmp'] ?? '';


    if (empty($existEmp)) {

        $sql = "INSERT INTO users (user_id, image,  name, surname, email, password, Position_ID, Departament_ID, role, location, status, report_to, gender, born, started,company) VALUES
        (null, null,  :name, :surname, :email, :password, null, null, 1, null, null, null, null, null, null,:company)";

        $prep = $con->prepare($sql);

        $prep->bindParam(':name', $name);
        $prep->bindParam(':surname', $surname);
        $prep->bindParam(':email', $email);
        $prep->bindParam(':password', $password);
        $prep->bindParam(':company', $company_Id);

        $prep->execute();

    } elseif(!empty($existEmp)) {


        $sql = "SELECT * FROM users WHERE user_id=:user_id ";
        $prep = $con->prepare($sql);
        $prep->bindParam(':user_id', $existEmp);
        $prep->execute();
        $user = $prep->fetch();




        $newAdmin = "INSERT INTO admins (user_id, name, surname, email, password, owner, company_id)
        VALUES (:user_id, :name, :surname, :email, :password, 0, :company_id)";
        $prep = $con->prepare($newAdmin);
        $prep->bindParam(':user_id', $existEmp);
        $prep->bindParam(':name', $user['name']);
        $prep->bindParam(':surname', $user['surname']);
        $prep->bindParam(':email', $user['email']);
        $prep->bindParam(':password', $user['password']);
        $prep->bindParam(':company_id', $company_Id);


    }
    Header("Location:authorisedUsers.php");
    exit;
}
if (isset($_POST['editExpense'])) {



}

$allUsers = "SELECT * FROM users WHERE company=:company_id ";
$prep = $con->prepare($allUsers);
$prep->bindParam(':company_id', $company_Id);
$prep->execute();
$users = $prep->fetchAll();


$authUsersQuery = "SELECT * FROM admins
WHERE company_id=:company_id";
$prep = $con->prepare($authUsersQuery);
$prep->bindParam(':company_id', $company_Id);
$prep->execute();
$authusers = $prep->fetchAll();


?>