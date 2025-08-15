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
        $prep->bindParam(':company', $companyId);

        $prep->execute();

    } else {
        $sql = "UPDATE users SET role = 1 WHERE user_id=:user_id";
        $prep = $con->prepare($sql);

        $prep->bindParam(':user_id', $existEmp);

        $prep->execute();
    }
    Header("Location:authorisedUsers.php");
    exit;
}
if (isset($_POST['editExpense'])) {



}

$allUsers = "SELECT * FROM users WHERE company=:company_id AND role=0";
$prep = $con->prepare($allUsers);
$prep->bindParam(':company_id', $company_Id);
$prep->execute();
$users = $prep->fetchAll();


$authUsersQuery = "SELECT * FROM users
WHERE company=:company_id AND role=1";
$prep = $con->prepare($authUsersQuery);
$prep->bindParam(':company_id', $company_Id);
$prep->execute();
$authusers = $prep->fetchAll();


?>