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
                                            <div class="row">
                                                <label for="departament">Departament Name</label>
                                                <input type="text" name="departament">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn-exit" data-bs-dismiss="modal">Close</button>
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
                            <?php foreach($departaments as $departament): ?>
                            <tr>
                                <td><?= $departament['departament_name'] ?></td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#editDepartamentModal"
                                        data-bs-whatever="@mdo" class="editCategory"> <i class="fa fa-edit"></i> </a>
                                    <a href="categoriesLogic?departament_id=<?=$goalitem['id'] ?> " class="deleteCategory"> <i class="fa fa-trash"></i></a>
                                </td>
                                <div class="modal fade-edit-DepartamentModal" id="editDepartamentModal" tabindex="-1"
                                    aria-labelledby="editDepartamentModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content animated slideInTop">
                                            <form action="categoriesLogic.php" method="post"
                                                enctype="multipart/form-data">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">×</button>
                                                    <h4 class="modal-title" id="exampleModalLabel">Edit Departament</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="beginning-part">
                                                        <div class="row">
                                                            <label for="position">Departament Name</label>
                                                            <input type="text" name="position">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn-exit"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="saveDepartament"
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
                    <p>Departaments let you separate employees into their areas. You can set up access permissions to
                        employees, documents and other data based on their Departament, so please set them up with this
                        in mind.</p>
                </div>
            </div>
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
                                            <div class="row">
                                                <label for="position">Departament Name</label>
                                                <input type="text" name="position">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn-exit" data-bs-dismiss="modal">Close</button>
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
                            <?php foreach($positions as $position): ?>
                            <tr>
                                <td><?= $position['position_name'] ?></td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#editDepartamentModal"
                                        data-bs-whatever="@mdo" class="editCategory"> <i class="fa fa-edit"></i> </a>
                                    <a href="categoriesLogic?departament_id=<?=$goalitem['id'] ?> " class="deleteCategory"> <i class="fa fa-trash"></i></a>
                                </td>
                                <div class="modal fade-edit-DepartamentModal" id="editDepartamentModal" tabindex="-1"
                                    aria-labelledby="editDepartamentModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content animated slideInTop">
                                            <form action="categoriesLogic.php" method="post"
                                                enctype="multipart/form-data">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">×</button>
                                                    <h4 class="modal-title" id="exampleModalLabel">Edit Departament</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="beginning-part">
                                                        <div class="row">
                                                            <label for="position">Departament Name</label>
                                                            <input type="text" name="position">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn-exit"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="assignGoal"
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
                    <p>This is a list of all positions or position titles within your company. You can create as many as you wish.</p>
                </div>
            </div>
        </div>


        <?php include '../template/footer.php'; ?>
    </div>

</body>

</html>