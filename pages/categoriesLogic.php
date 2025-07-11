<?php

require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];

$departamentsQuery = "SELECT * FROM departament WHERE company_id=:company_id";
$prep = $con->prepare($departamentsQuery);
$prep->bindParam(':company_id', $companyId);
$prep->execute();
$departaments = $prep->fetchAll();


$positionsQuery = "SELECT * FROM position WHERE company_id=:company_id";
$prep = $con->prepare($positionsQuery);
$prep->bindParam(':company_id', $companyId);
$prep->execute();
$positions = $prep->fetchAll();

if (isset($_POST['addDepartament'])) {
    $departament_name = $_POST['departament'];

    $addDepartamentQuery = "INSERT INTO departament(departament_id, departament_name,company_id) VALUES (null, :departament_name, :company_id)";
    $prep = $con->prepare($addDepartamentQuery);
    $prep->bindParam(':departament_name', $departament_name);
    $prep->bindParam(':company_id', $companyId);
    $prep->execute();

    header("Location: /HrSystem/pages/categories.php");
}
if (isset($_POST['editDepartament'])) {

    $departament_name = $_POST['departament'];
    $departament_id = $_POST['departament_id'];

    $editDepartamentQuery = " UPDATE  departament SET  departament_name=:departament_name, company_id=:company_id where departament_id=:departament_id";
    $prep = $con->prepare($editDepartamentQuery);
    $prep->bindParam(':departament_name', $departament_name);
    $prep->bindParam(':departament_id', $departament_id);
    $prep->bindParam(':company_id', $companyId);

    $prep->execute();

    header("Location: /HrSystem/pages/categories.php");

}

  if (isset($_GET['departament_id'])) {
        $departament_id = $_GET['departament_id'];
        $sql = "DELETE FROM departament WHERE departament_id = :departament_id";
        $prep = $con->prepare($sql);
        $prep->bindParam(':departament_id', $departament_id, PDO::PARAM_INT);
        $prep->execute();

        header("Location: /HrSystem/pages/categories.php");
      
    }
if (isset($_POST['addPosition'])) {

    $position_name = $_POST['position'];

    $addPositiontQuery = "INSERT INTO `position`(position_id, position_name,company_id ) VALUES (null, :position_name, :company_id )";
    $prep = $con->prepare($addPositiontQuery);
    $prep->bindParam(':position_name', $position_name);
    $prep->bindParam(':company_id', $companyId);
    $prep->execute();

    header("Location: /HrSystem/pages/categories.php");
}

if (isset($_POST['editPosition'])) {

    $position_name = $_POST['position'];
    $position_id = $_POST['position_id'];

    $editPositionQuery = " UPDATE  position SET  position_name=:position_name, company_id=:company_id where position_id=:position_id";
    $prep = $con->prepare($editPositionQuery);
    $prep->bindParam(':position_name', $position_name);
    $prep->bindParam(':position_id', $position_id);
    $prep->bindParam(':company_id', $companyId);

    $prep->execute();

    header("Location: /HrSystem/pages/categories.php");

}
if (isset($_GET['position_id'])) {
        $position_id = $_GET['position_id'];
        $sql = "DELETE FROM position WHERE position_id = :position_id";
        $prep = $con->prepare($sql);
        $prep->bindParam(':position_id', $position_id, PDO::PARAM_INT);
        $prep->execute();

        header("Location: /HrSystem/pages/categories.php");
      
    }
?>