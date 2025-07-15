<?php

require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];


// Departament
// Fetch Departaments
$positionsQuery = "SELECT * FROM position WHERE company_id=:company_id";
$prep = $con->prepare($positionsQuery);
$prep->bindParam(':company_id', $companyId);
$prep->execute();
$positions = $prep->fetchAll();

//Add new Departament

if (isset($_POST['addDepartament'])) {
    $departament_name = $_POST['departament'];

    $addDepartamentQuery = "INSERT INTO departament(departament_id, departament_name,company_id) VALUES (null, :departament_name, :company_id)";
    $prep = $con->prepare($addDepartamentQuery);
    $prep->bindParam(':departament_name', $departament_name);
    $prep->bindParam(':company_id', $companyId);
    $prep->execute();

    header("Location: /HrSystem/pages/categories.php");
}

//Edit Departament
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
//Delete Departament
if (isset($_GET['departament_id'])) {
    $departament_id = $_GET['departament_id'];
    $sql = "DELETE FROM departament WHERE departament_id = :departament_id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':departament_id', $departament_id, PDO::PARAM_INT);
    $prep->execute();

    header("Location: /HrSystem/pages/categories.php");

}
// Position
// Fetch Positions
$departamentsQuery = "SELECT * FROM departament WHERE company_id=:company_id";
$prep = $con->prepare($departamentsQuery);
$prep->bindParam(':company_id', $companyId);
$prep->execute();
$departaments = $prep->fetchAll();

// Add new Position
if (isset($_POST['addPosition'])) {

    $position_name = $_POST['position'];

    $addPositiontQuery = "INSERT INTO `position`(position_id, position_name,company_id ) VALUES (null, :position_name, :company_id )";
    $prep = $con->prepare($addPositiontQuery);
    $prep->bindParam(':position_name', $position_name);
    $prep->bindParam(':company_id', $companyId);
    $prep->execute();

    header("Location: /HrSystem/pages/categories.php");
}
// Edit Position
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
// Delete Position
if (isset($_GET['position_id'])) {
    $position_id = $_GET['position_id'];
    $sql = "DELETE FROM position WHERE position_id = :position_id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':position_id', $position_id, PDO::PARAM_INT);
    $prep->execute();

    header("Location: /HrSystem/pages/categories.php");

}
// Location
// Fetch Locations
$locationsQuery = "SELECT * FROM `locations` WHERE company_id=:company_id";
$prep = $con->prepare($locationsQuery);
$prep->bindParam(':company_id', $companyId);
$prep->execute();
$locations = $prep->fetchAll();

// Add new Location
if (isset($_POST['addLocation'])) {

    $location_name = $_POST['location'];
    $country = $_POST['country'];
    $timezone = $_POST['timezone'];

    $addPositiontQuery = "INSERT INTO `locations`(location_id, location_name, country, timezone, company_id ) VALUES (null, :location_name,:country,:timezone, :company_id )";
    $prep = $con->prepare($addPositiontQuery);
    $prep->bindParam(':location_name', $location_name);
    $prep->bindParam(':country', $country);
    $prep->bindParam(':timezone', $timezone);
    $prep->bindParam(':company_id', $companyId);
    $prep->execute();

    header("Location: /HrSystem/pages/categories.php");
}
// Edit Location
if (isset($_POST['editLocation'])) {

    $location_id = $_POST['location_id'];
    $location_name = $_POST['location'];
    $country = $_POST['country'];
    $timezone = $_POST['timezone'];

   $editLocationQuery = "UPDATE `locations` SET location_name = :location_name, country = :country, timezone = :timezone 
    WHERE location_id = :location_id
";

$prep = $con->prepare($editLocationQuery);
$prep->bindParam(':location_name', $location_name);
$prep->bindParam(':country', $country);
$prep->bindParam(':timezone', $timezone);
$prep->bindParam(':location_id', $location_id);

$prep->execute();

    header("Location: /HrSystem/pages/categories.php");

}
// Delete Location
if (isset($_GET['location_id'])) {
    $location_id = $_GET['location_id'];
    $sql = "DELETE FROM `locations` WHERE location_id = :location_id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':location_id', $location_id, PDO::PARAM_INT);
    $prep->execute();

    header("Location: /HrSystem/pages/categories.php");

}

// News Categories
// Fetch News Categories
$newscategoriesQuery = "SELECT * FROM newscategories WHERE company_id=:company_id";
$prep = $con->prepare($newscategoriesQuery);
$prep->bindParam(':company_id', $companyId);
$prep->execute();
$NewsCategories = $prep->fetchAll();

// Add new News Category
if (isset($_POST['addNewsCategory'])) {

    $newscategory_name = $_POST['NewsCategory'];

    $addnewscategoriesQuery = "INSERT INTO `newscategories`(newscategory_id, newscategory_name,company_id ) VALUES (null, :newscategory_name, :company_id )";
    $prep = $con->prepare($addnewscategoriesQuery);
    $prep->bindParam(':newscategory_name', $newscategory_name);
    $prep->bindParam(':company_id', $companyId);
    $prep->execute();

    header("Location: /HrSystem/pages/categories.php");
}
// Edit News Category
if (isset($_POST['editNewsCategory'])) {

    $newscategory_name = $_POST['NewsCategory'];
    $newscategory_id = $_POST['newscategory_id'];

    $editnewscategoriesQuery = " UPDATE  newscategories SET  newscategory_name=:newscategory_name, company_id=:company_id where newscategory_id=:newscategory_id";
    $prep = $con->prepare($editnewscategoriesQuery);
    $prep->bindParam(':newscategory_name', $newscategory_name);
    $prep->bindParam(':newscategory_id', $newscategory_id);
    $prep->bindParam(':company_id', $companyId);

    $prep->execute();

    header("Location: /HrSystem/pages/categories.php");

}
// Delete News Category
if (isset($_GET['newscategory_id'])) {
    $newscategory_id = $_GET['newscategory_id'];
    $sql = "DELETE FROM newscategories WHERE newscategory_id = :newscategory_id";
    $prep = $con->prepare($sql);
    $prep->bindParam(':newscategory_id', $newscategory_id, PDO::PARAM_INT);
    $prep->execute();

    header("Location: /HrSystem/pages/categories.php");

}
?>