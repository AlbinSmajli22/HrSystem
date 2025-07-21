<?php

include './categoriesLogic.php'

    ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/categories.css">
    <script src="https://kit.fontawesome.com/3d560ffcbd.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
        crossorigin="anonymous"></script>
</head>

<body style="background-color: #F4F6FA;">
    <div>
        <?php include '../template/sidebar.php' ?>
    </div>
    <div class="content">
        <?php include '../template/navbar.php' ?>
        <div class="authUserHead">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>
        <div id="well">
            <p>These are the various categories that employees can have (i.e. departaments, employment type etc.).
                Please ensure that you set these up before you begin creating or importing employees.
            </p>
            <p>You can change them later, but pleasa be aware that this will affect all employees already in the
                system, so pleae be carefully.
            </p>
        </div>
        <div class="categories">

            <div class="categories-left">
                <div class="categories-tables">
                    <div class="categories-tables-head">
                        <h5>
                            <i class="fa-solid fa-list"></i>
                            Departaments
                        </h5>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addDepartamentModal"
                            data-bs-whatever="@mdo">
                            <i class="fa-solid fa-plus"></i>
                            Add Departament
                        </button>
                        <div class="modal fade-add-DepartamentModal" id="addDepartamentModal" tabindex="-1"
                            aria-labelledby="addDepartamentModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated slideInTop">
                                    <form action="categoriesLogic.php" method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">×</button>
                                            <h4 class="modal-title" id="exampleModalLabel">Add Departament</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="beginning-part">
                                                <div class="inputs">
                                                    <label for="departament">Departament Name</label>
                                                    <input type="text" name="departament">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-exit"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addDepartament" class="btn-save">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="categories-tables-body">
                        <table class="categories-table">
                            <thead>
                                <tr>
                                    <th>name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($departaments as $departament): ?>
                                    <tr>
                                        <td><?= $departament['departament_name'] ?></td>
                                        <td>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#editDepartamentModal<?= $departament['departament_id'] ?>"
                                                data-bs-whatever="@mdo" class="editCategory"> <i class="fa fa-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#deleteDepartamentModal<?= $departament['departament_id'] ?>"
                                                data-bs-whatever="@mdo" class="deleteCategory"><i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <div class="modal fade-delete-DepartamentModal"
                                            id="deleteDepartamentModal<?= $departament['departament_id'] ?>" tabindex="-1"
                                            aria-labelledby="deleteDepartamentModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <div class="modal-header-delete">
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">×</button>
                                                        <h6 class="modal-title" id="exampleModalLabel">Delete Position</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="delete-part-two">

                                                            <p>This will delete this item: <span>
                                                                    <?= $departament['departament_name'] ?> </span> </p>
                                                            <p>This process is NOT reversible and will result in PERMANENT
                                                                loss
                                                                of data. Please be
                                                                ABSOLUTELY sure that you wish to remove this information
                                                            </p>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn-exit"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="categoriesLogic.php?departament_id=<?= $departament['departament_id'] ?>"
                                                            class="deleteButton">delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade-edit-DepartamentModal"
                                            id="editDepartamentModal<?= $departament['departament_id'] ?>" tabindex="-1"
                                            aria-labelledby="editDepartamentModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <form action="categoriesLogic.php" method="post">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">×</button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Edit Departament
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="beginning-part">
                                                                <div class="inputs">
                                                                    <input type="hidden" name="departament_id" id=""
                                                                        value="<?= $departament['departament_id'] ?>">
                                                                    <label for="departament">Departament Name</label>
                                                                    <input type="text" name="departament"
                                                                        value="<?= $departament['departament_name'] ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn-exit"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="editDepartament"
                                                                class="btn-save">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="categories-tables-footer">
                        <img src="../images/qustionmark.png" alt="">
                        <p>Departaments let you separate employees into their areas. You can set up access permissions
                            to
                            employees, documents and other data based on their Departament, so please set them up with
                            this
                            in mind.</p>
                    </div>
                </div>
                <div class="categories-tables">
                    <div class="categories-tables-head">
                        <h5>
                            <i class="fa-solid fa-list"></i>
                            Locations
                        </h5>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addLocationModal"
                            data-bs-whatever="@mdo">
                            <i class="fa-solid fa-plus"></i>
                            Add Location
                        </button>
                        <div class="modal fade-add-LocationModal" id="addLocationModal" tabindex="-1"
                            aria-labelledby="addLocationModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated slideInTop">
                                    <form action="categoriesLogic.php" method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">×</button>
                                            <h4 class="modal-title" id="exampleModalLabel">Add Location</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="beginning-part">
                                                <div class="inputs">
                                                    <label for="location">Location Name</label>
                                                    <input type="text" name="location" id="location">
                                                </div>
                                                <div class="drop-downs">
                                                    <div class="row-2">
                                                        <label for="country">Country</label>
                                                        <select id="country" name="country">
                                                        </select>

                                                    </div>
                                                    <div class="row-2">
                                                        <label for="timezone">Timezone</label>
                                                        <select id="timezone" name="timezone">
                                                            <option value="" disabled selected>UCT</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-exit"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addLocation" class="btn-save">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="categories-tables-body">
                        <table class="categories-table">
                            <thead>
                                <tr>
                                    <th>name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($locations as $location): ?>
                                    <tr>
                                        <td><?= $location['location_name'] ?></td>
                                        <td>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#editLocationModal<?= $location['location_id'] ?>"
                                                data-bs-whatever="@mdo" class="editCategory"> <i class="fa fa-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#deleteLocationModal<?= $location['location_id'] ?>"
                                                data-bs-whatever="@mdo" class="deleteCategory"> <i
                                                    class="fa fa-trash"></i></a>
                                        </td>
                                        <div class="modal fade-delete-LocationModal"
                                            id="deleteLocationModal<?= $location['location_id'] ?>" tabindex="-1"
                                            aria-labelledby="deleteLocationModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <div class="modal-header-delete">
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">×</button>
                                                        <h6 class="modal-title" id="exampleModalLabel">Delete Location</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="delete-part-two">

                                                            <p>This will delete this item: <span>
                                                                    <?= $location['location_name'] ?> </span> </p>
                                                            <p>This process is NOT reversible and will result in PERMANENT
                                                                loss
                                                                of data. Please be
                                                                ABSOLUTELY sure that you wish to remove this information
                                                            </p>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn-exit"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="categoriesLogic.php?location_id=<?= $location['location_id'] ?>"
                                                            class="deleteButton">delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade-edit-LocationModal"
                                            id="editLocationModal<?= $location['location_id'] ?>" tabindex="-1"
                                            aria-labelledby="editLocationModalLabel" aria-hidden="true"
                                            data-selected-country="<?= htmlspecialchars($location['country']) ?>"
                                            data-selected-timezone="<?= htmlspecialchars($location['timezone']) ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <form action="categoriesLogic.php" method="post"
                                                        enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">×</button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Edit Location
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="beginning-part">
                                                                <div class="inputs">
                                                                    <input type="hidden" name="location_id" id="location_id"
                                                                        value="<?= $location['location_id'] ?>">
                                                                    <label for="location">Location Name</label>
                                                                    <input type="text" name="location" id="location"
                                                                        value="<?= $location['location_name'] ?>">
                                                                </div>
                                                                <div class="drop-downs">
                                                                    <div class="row-2">
                                                                        <label for="country">Country</label>
                                                                        <select id="country" name="country"
                                                                            class="country-select">

                                                                        </select>

                                                                    </div>
                                                                    <div class="row-2">
                                                                        <label
                                                                            for="timezone<?= $location['location_id'] ?>">Timezone</label>
                                                                        <select class="form-control timezone-select"
                                                                            id="timezone<?= $location['location_id'] ?>"></select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn-exit"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="editLocation"
                                                                    class="btn-save">Save</button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="categories-tables-footer">
                        <img src="../images/qustionmark.png" alt="">
                        <p>You can allocate your employees to a particulat location, and set permission based on them.
                            You can also change timezones for each location if your employees are spread across
                            different
                            regions. </p>
                    </div>
                </div>
                <div class="categories-tables">
                    <div class="categories-tables-head">
                        <h5>
                            <i class="fa-solid fa-list"></i>
                            Employment Statuses
                        </h5>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addEmploymentStatusesModal"
                            data-bs-whatever="@mdo">
                            <i class="fa-solid fa-plus"></i>
                            Add Employment Status
                        </button>
                        <div class="modal fade-add-EmploymentStatusesModal" id="addEmploymentStatusesModal" tabindex="-1"
                            aria-labelledby="addEmploymentStatusesModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated slideInTop">
                                    <form action="categoriesLogic.php" method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">×</button>
                                            <h4 class="modal-title" id="exampleModalLabel">Add Employment Statuse</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="beginning-part">
                                                <div class="inputs">
                                                    <label for="employmentStatus">Employment Statuse Name</label>
                                                    <input type="text" name="employmentStatus" id="employmentStatus">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-exit"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addEmploymentStatus" class="btn-save">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="categories-tables-body">
                        <table class="categories-table">
                            <thead>
                                <tr>
                                    <th>name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($employmentStatuses as $empStatus): ?>
                                    <tr>
                                        <td><?= $empStatus['employmentstatus_name'] ?></td>
                                        <td>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#editEmploymentStatusesModal<?= $empStatus['employmentstatus_id'] ?>"
                                                data-bs-whatever="@mdo" class="editCategory"> <i class="fa fa-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#deleteEmploymentStatusesModal<?= $empStatus['employmentstatus_id'] ?>"
                                                data-bs-whatever="@mdo" class="deleteCategory"> <i
                                                    class="fa fa-trash"></i></a>
                                        </td>
                                        <div class="modal fade-delete-EmploymentStatusesModal"
                                            id="deleteEmploymentStatusesModal<?= $empStatus['employmentstatus_id'] ?>"
                                            tabindex="-1" aria-labelledby="deleteEmploymentStatusesModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <div class="modal-header-delete">
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">×</button>
                                                        <h6 class="modal-title" id="exampleModalLabel">Delete Employment Status
                                                        </h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="delete-part-two">

                                                            <p>This will delete this item: <span>
                                                                    <?= $empStatus['employmentstatus_name'] ?> </span> </p>
                                                            <p>This process is NOT reversible and will result in PERMANENT
                                                                loss
                                                                of data. Please be
                                                                ABSOLUTELY sure that you wish to remove this information
                                                            </p>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn-exit"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="categoriesLogic.php?employmentstatus_id=<?= $empStatus['employmentstatus_id'] ?>"
                                                            class="deleteButton">delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade-edit-EmploymentStatusesModal"
                                            id="editEmploymentStatusesModal<?= $empStatus['employmentstatus_id'] ?>"
                                            tabindex="-1" aria-labelledby="editEmploymentStatusesModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <form action="categoriesLogic.php" method="post"
                                                        enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">×</button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Edit Employment Status
                                                                Category
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="beginning-part">
                                                                <div class="inputs">
                                                                    <input type="hidden" name="employmentstatus_id"
                                                                        id="employmentstatus_id"
                                                                        value="<?= $empStatus['employmentstatus_id'] ?>">
                                                                    <label for="employmentStatus">News Category Name</label>
                                                                    <input type="text" name="employmentStatus" id="employmentStatus"
                                                                        value="<?= $empStatus['employmentstatus_name'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn-exit"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="editEmploymentStatus"
                                                                    class="btn-save">Save</button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="categories-tables-footer">
                        <img src="../images/qustionmark.png" alt="">
                        <p>These should ideally match your payroll system.
                        </p>
                    </div>
                </div>
                <div class="categories-tables">
                    <div class="categories-tables-head">
                        <h5>
                            <i class="fa-solid fa-list"></i>
                            Custom Contact Types
                        </h5>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addContactTypesModal"
                            data-bs-whatever="@mdo">
                            <i class="fa-solid fa-plus"></i>
                            Add Contact Type
                        </button>
                        <div class="modal fade-add-ContactTypesModal" id="addContactTypesModal" tabindex="-1"
                            aria-labelledby="addContactTypesModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated slideInTop">
                                    <form action="categoriesLogic.php" method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">×</button>
                                            <h4 class="modal-title" id="exampleModalLabel">Add Contact Type</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="beginning-part">
                                                <div class="inputs">
                                                    <label for="ContactType">Contact Type Name</label>
                                                    <input type="text" name="ContactType" id="ContactType">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-exit"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addContactType" class="btn-save">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="categories-tables-body">
                        <table class="categories-table">
                            <thead>
                                <tr>
                                    <th>name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($contactTypes as $contactType): ?>
                                    <tr>
                                        <td><?= $contactType['contacttype_name'] ?></td>
                                        <td>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#editContactTypesModal<?= $contactType['contacttype_id'] ?>"
                                                data-bs-whatever="@mdo" class="editCategory"> <i class="fa fa-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#deleteContactTypesModal<?= $contactType['contacttype_id'] ?>"
                                                data-bs-whatever="@mdo" class="deleteCategory"> <i
                                                    class="fa fa-trash"></i></a>
                                        </td>
                                        <div class="modal fade-delete-ContactTypesModal"
                                            id="deleteContactTypesModal<?= $contactType['contacttype_id'] ?>"
                                            tabindex="-1" aria-labelledby="deleteContactTypesModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <div class="modal-header-delete">
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">×</button>
                                                        <h6 class="modal-title" id="exampleModalLabel">Delete Employment Status
                                                        </h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="delete-part-two">

                                                            <p>This will delete this item: <span>
                                                                    <?= $contactType['contacttype_name'] ?> </span> </p>
                                                            <p>This process is NOT reversible and will result in PERMANENT
                                                                loss
                                                                of data. Please be
                                                                ABSOLUTELY sure that you wish to remove this information
                                                            </p>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn-exit"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="categoriesLogic.php?contacttype_id=<?= $contactType['contacttype_id'] ?>"
                                                            class="deleteButton">delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade-edit-ContactTypesModal"
                                            id="editContactTypesModal<?= $contactType['contacttype_id'] ?>"
                                            tabindex="-1" aria-labelledby="editContactTypesModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <form action="categoriesLogic.php" method="post"
                                                        enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">×</button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Edit Employment Status
                                                                Category
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="beginning-part">
                                                                <div class="inputs">
                                                                    <input type="hidden" name="contacttype_id"
                                                                        id="contacttype_id"
                                                                        value="<?= $contactType['contacttype_id'] ?>">
                                                                    <label for="ContactType">News Category Name</label>
                                                                    <input type="text" name="ContactType" id="ContactType"
                                                                        value="<?= $contactType['contacttype_name'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn-exit"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="editContactType"
                                                                    class="btn-save">Save</button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="categories-tables-footer">
                        <img src="../images/qustionmark.png" alt="">
                        <p>You can add custom contact types.
                        </p>
                    </div>
                </div>
            </div>
            <div class="categories-right">
                <div class="categories-tables">
                    <div class="categories-tables-head">
                        <h5>
                            <i class="fa-solid fa-list"></i>
                            Positions
                        </h5>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addPositionModal"
                            data-bs-whatever="@mdo">
                            <i class="fa-solid fa-plus"></i>
                            Add Position
                        </button>
                        <div class="modal fade-add-PositionModal" id="addPositionModal" tabindex="-1"
                            aria-labelledby="addPositionModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated slideInTop">
                                    <form action="categoriesLogic.php" method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">×</button>
                                            <h4 class="modal-title" id="exampleModalLabel">Add Position</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="beginning-part">
                                                <div class="inputs">
                                                    <label for="position">Departament Name</label>
                                                    <input type="text" name="position">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-exit"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addPosition" class="btn-save">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="categories-tables-body">
                        <table class="categories-table">
                            <thead>
                                <tr>
                                    <th>name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($positions as $position): ?>
                                    <tr>
                                        <td><?= $position['position_name'] ?></td>
                                        <td>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#editPositionModal<?= $position['position_id'] ?>"
                                                data-bs-whatever="@mdo" class="editCategory"> <i class="fa fa-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#deletePositionModal<?= $position['position_id'] ?>"
                                                data-bs-whatever="@mdo" class="deleteCategory"> <i
                                                    class="fa fa-trash"></i></a>
                                        </td>
                                        <div class="modal fade-delete-PositionModal"
                                            id="deletePositionModal<?= $position['position_id'] ?>" tabindex="-1"
                                            aria-labelledby="deletePositionModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <div class="modal-header-delete">
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">×</button>
                                                        <h6 class="modal-title" id="exampleModalLabel">Delete Position</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="delete-part-two">

                                                            <p>This will delete this item: <span>
                                                                    <?= $position['position_name'] ?> </span> </p>
                                                            <p>This process is NOT reversible and will result in PERMANENT
                                                                loss
                                                                of data. Please be
                                                                ABSOLUTELY sure that you wish to remove this information
                                                            </p>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn-exit"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="categoriesLogic.php?position_id=<?= $position['position_id'] ?>"
                                                            class="deleteButton">delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade-edit-PositionModal"
                                            id="editPositionModal<?= $position['position_id'] ?>" tabindex="-1"
                                            aria-labelledby="editPositionModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <form action="categoriesLogic.php" method="post"
                                                        enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">×</button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Edit Position
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="beginning-part">
                                                                <div class="inputs">
                                                                    <input type="hidden" name="position_id" id=""
                                                                        value="<?= $position['position_id'] ?>">
                                                                    <label for="position">Departament Name</label>
                                                                    <input type="text" name="position"
                                                                        value="<?= $position['position_name'] ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn-exit"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="editPosition"
                                                                class="btn-save">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="categories-tables-footer">
                        <img src="../images/qustionmark.png" alt="">
                        <p>This is a list of all positions or position titles within your company. You can create as
                            many as
                            you wish.</p>
                    </div>
                </div>

                <div class="categories-tables">
                    <div class="categories-tables-head">
                        <h5>
                            <i class="fa-solid fa-list"></i>
                            News Category
                        </h5>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addNewsCategoriesModal"
                            data-bs-whatever="@mdo">
                            <i class="fa-solid fa-plus"></i>
                            Add News Category
                        </button>
                        <div class="modal fade-add-NewsCategoriesModal" id="addNewsCategoriesModal" tabindex="-1"
                            aria-labelledby="addNewsCategoriesModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated slideInTop">
                                    <form action="categoriesLogic.php" method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">×</button>
                                            <h4 class="modal-title" id="exampleModalLabel">Add News Category</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="beginning-part">
                                                <div class="inputs">
                                                    <label for="NewsCategory">News Category Name</label>
                                                    <input type="text" name="NewsCategory" id="NewsCategory">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-exit"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addNewsCategory" class="btn-save">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="categories-tables-body">
                        <table class="categories-table">
                            <thead>
                                <tr>
                                    <th>name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($NewsCategories as $NewsCategory): ?>
                                    <tr>
                                        <td><?= $NewsCategory['newscategory_name'] ?></td>
                                        <td>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#editNewsCategoriesModal<?= $NewsCategory['newscategory_id'] ?>"
                                                data-bs-whatever="@mdo" class="editCategory"> <i class="fa fa-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#deleteNewsCategoriesModal<?= $NewsCategory['newscategory_id'] ?>"
                                                data-bs-whatever="@mdo" class="deleteCategory"> <i
                                                    class="fa fa-trash"></i></a>
                                        </td>
                                        <div class="modal fade-delete-NewsCategoriesModal"
                                            id="deleteNewsCategoriesModal<?= $NewsCategory['newscategory_id'] ?>"
                                            tabindex="-1" aria-labelledby="deleteNewsCategoriesModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <div class="modal-header-delete">
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">×</button>
                                                        <h6 class="modal-title" id="exampleModalLabel">Delete News Category
                                                        </h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="delete-part-two">

                                                            <p>This will delete this item: <span>
                                                                    <?= $NewsCategory['newscategory_name'] ?> </span> </p>
                                                            <p>This process is NOT reversible and will result in PERMANENT
                                                                loss
                                                                of data. Please be
                                                                ABSOLUTELY sure that you wish to remove this information
                                                            </p>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn-exit"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="categoriesLogic.php?newscategory_id=<?= $NewsCategory['newscategory_id'] ?>"
                                                            class="deleteButton">delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade-edit-NewsCategoriesModal"
                                            id="editNewsCategoriesModal<?= $NewsCategory['newscategory_id'] ?>"
                                            tabindex="-1" aria-labelledby="editNewsCategoriesModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <form action="categoriesLogic.php" method="post"
                                                        enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">×</button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Edit News
                                                                Category
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="beginning-part">
                                                                <div class="inputs">
                                                                    <input type="hidden" name="newscategory_id"
                                                                        id="newscategory_id"
                                                                        value="<?= $NewsCategory['newscategory_id'] ?>">
                                                                    <label for="NewsCategory">News Category Name</label>
                                                                    <input type="text" name="NewsCategory" id="NewsCategory"
                                                                        value="<?= $NewsCategory['newscategory_name'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn-exit"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="editNewsCategory"
                                                                    class="btn-save">Save</button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="categories-tables-footer">
                        <img src="../images/qustionmark.png" alt="">
                        <p>These are categories that you allocate to your news articles for your employees. </p>
                    </div>
                </div>
                <div class="categories-tables">
                    <div class="categories-tables-head">
                        <h5>
                            <i class="fa-solid fa-tag"></i>
                            Tags
                        </h5>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addTagsModal"
                            data-bs-whatever="@mdo">
                            <i class="fa-solid fa-plus"></i>
                            Add Tag
                        </button>
                        <div class="modal fade-add-TagsModal" id="addTagsModal" tabindex="-1"
                            aria-labelledby="addTagsModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated slideInTop">
                                    <form action="categoriesLogic.php" method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">×</button>
                                            <h4 class="modal-title" id="exampleModalLabel">Add Tag</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="beginning-part">
                                                <div class="inputs">
                                                    <label for="tag">Tag Name</label>
                                                    <input type="text" name="tag" id="tag">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-exit"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addTag" class="btn-save">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="categories-tables-body">
                        <table class="categories-table">
                            <thead>
                                <tr>
                                    <th>name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tags as $tag): ?>
                                    <tr>
                                        <td><?= $tag['tag_name'] ?></td>
                                        <td>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#editTagsModal<?= $tag['tag_id'] ?>"
                                                data-bs-whatever="@mdo" class="editCategory"> <i class="fa fa-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#deleteTagsModal<?= $tag['tag_id'] ?>"
                                                data-bs-whatever="@mdo" class="deleteCategory"> <i
                                                    class="fa fa-trash"></i></a>
                                        </td>
                                        <div class="modal fade-delete-TagsModal"
                                            id="deleteTagsModal<?= $tag['tag_id'] ?>"
                                            tabindex="-1" aria-labelledby="deleteTagsModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <div class="modal-header-delete">
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">×</button>
                                                        <h6 class="modal-title" id="exampleModalLabel">Delete Tag
                                                        </h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="delete-part-two">

                                                            <p>This will delete this item: <span>
                                                                    <?= $tag['tag_name'] ?> </span> </p>
                                                            <p>This process is NOT reversible and will result in PERMANENT
                                                                loss
                                                                of data. Please be
                                                                ABSOLUTELY sure that you wish to remove this information
                                                            </p>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn-exit"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="categoriesLogic.php?tag_id=<?= $tag['tag_id'] ?>"
                                                            class="deleteButton">delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade-edit-TagsModal"
                                            id="editTagsModal<?= $tag['tag_id'] ?>"
                                            tabindex="-1" aria-labelledby="editTagsModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <form action="categoriesLogic.php" method="post"
                                                        enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">×</button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Edit News
                                                                Category
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="beginning-part">
                                                                <div class="inputs">
                                                                    <input type="hidden" name="tag_id"
                                                                        id="tag_id"
                                                                        value="<?= $tag['tag_id'] ?>">
                                                                    <label for="tag">News Category Name</label>
                                                                    <input type="text" name="tag" id="tag"
                                                                        value="<?= $tag['tag_name'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn-exit"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="editTag"
                                                                    class="btn-save">Save</button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="categories-tables-footer">
                        <img src="../images/qustionmark.png" alt="">
                        <p>Tags allow you to categories and segment your employees even further.</br>
                           <strong>NOTE:</strong> You can allocate multiple tags to each employee.</br>
                           <strong>TIP:</strong> You can create a tag for eache project, or eache committee your emoployee
                           belongs too.
                        </p>
                    </div>
                </div>

            </div>


        </div>


        <?php include '../template/footer.php'; ?>
    </div>


    <script src="../js/categories.js" type="text/javascript"></script>
</body>

</html>