<?php 

require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];

$departamentsQuery="SELECT * FROM departament WHERE company_id=:company_id";
$prep=$con->prepare($departamentsQuery);
$prep->bindParam(':company_id', $companyId);
$prep->execute();
$departaments=$prep->fetchAll();


$positionsQuery="SELECT * FROM position WHERE company_id=:company_id";
$prep=$con->prepare($positionsQuery);
$prep->bindParam(':company_id', $companyId);
$prep->execute();
$positions=$prep->fetchAll();

if (isset($_POST['addDepartament'])) {
    $departament_name=$_POST['departament'];

    $addDepartamentQuery="INSERT INTO departament(departament_id, departament_name,company_id) VALUES (null, :departament_name, :company_id)";
    $prep=$con->prepare($addDepartamentQuery);
    $prep->bindParam(':departament_name', $departament_name);
    $prep->bindParam(':company_id', $companyId);
    $prep->execute();

    header("Location: /HrSystem/pages/categories.php");
}
if (isset($_POST['addPosition'])) {

    $position_name=$_POST['position'];

    $addPositiontQuery="INSERT INTO `position`(position_id, position_name,company_id ) VALUES (null, :position_name, :company_id )";
    $prep=$con->prepare($addPositiontQuery);
    $prep->bindParam(':position_name', $position_name);
    $prep->bindParam(':company_id', $companyId);
    $prep->execute();

    header("Location: /HrSystem/pages/categories.php");
}
?>