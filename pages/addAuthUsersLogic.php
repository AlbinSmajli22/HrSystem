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

        $sql2 = "INSERT INTO admins (user_id, name, surname, email, password, owner, company_id)
        VALUES (null, :name, :surname, :email, :password, :owner,:company_id )";

        $prep = $con->prepare($sql2);

        $prep->bindParam(':name', $name);
        $prep->bindParam(':surname', $surname);
        $prep->bindParam(':email', $email);
        $prep->bindParam(':password', $password);
        $prep->bindParam(':owner', $owner);
        $prep->bindParam(':company_id', $company_Id);

        $prep->execute();

    } else {


        $sql = "SELECT * FROM users WHERE user_id=:user_id ";
        $prep = $con->prepare($sql);
        $prep->bindParam(':user_id', $existEmp);
        $prep->execute();
        $user = $prep->fetch();

        $owner = 0;




        $newAdmin = "INSERT INTO admins (user_id, name, surname, email, password, owner, company_id)
        VALUES (:user_id, :name, :surname, :email, :password, :owner, :company_id)";
        $prep = $con->prepare($newAdmin);
        $prep->bindParam(':user_id', $existEmp);
        $prep->bindParam(':name', $user['name']);
        $prep->bindParam(':surname', $user['surname']);
        $prep->bindParam(':email', $user['email']);
        $prep->bindParam(':password', $user['password']);
        $prep->bindParam(':company_id', $company_Id);
        $prep->bindParam(':owner', $owner);


        $prep->execute();
        Header("Location:authorisedUsers.php");

    }
    Header("Location:authorisedUsers.php");
    exit;
}
if (isset($_POST['editAuthUser'])) {

    $name = $_POST['firsName'] ?? '';
    $surname = $_POST['lastName'] ?? '';
    $existEmp = $_POST['existEmp'] ?? '';
    $admin_id = $_POST['admin_id'] ?? '';

    if (empty($existEmp)) {

        $sql2 = "UPDATE admins SET  name=:name, surname=:surname WHERE admin_id=:admin_id";

        $prep = $con->prepare($sql2);

       
        $prep->bindParam(':name', $name);
        $prep->bindParam(':surname', $surname);
        $prep->bindParam(':admin_id', $admin_id);

        $prep->execute();

    } else {


        $sql = "SELECT * FROM users WHERE user_id=:user_id ";
        $prep = $con->prepare($sql);
        $prep->bindParam(':user_id', $existEmp);
        $prep->execute();
        $user = $prep->fetch();



        $newAdmin = "UPDATE admins SET user_id = :user_id WHERE admin_id=:admin_id";
        $prep = $con->prepare($newAdmin);
        $prep->bindParam(':user_id', $existEmp);
        $prep->bindParam(':admin_id', $admin_id);



        $prep->execute();


    }
    Header("Location:authorisedUsers.php");
    exit;
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