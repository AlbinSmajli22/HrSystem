<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];


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
                    <button>
                        <i class="fa-solid fa-plus"></i>
                        Add Departament
                    </button>
                </div>
                <div class="categories-tables-body">
                    <table class="categories-table">
                        <thead>
                            <tr>
                                <th>name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Administration</td>
                                <td>
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Finance</td>
                                <td>
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>General</td>
                                <td>
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>General</td>
                                <td>
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>General</td>
                                <td>
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>General</td>
                                <td>
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="categories-tables">
                <div class="categories-tables-head">
                    <h5>
                        <i class="fa-solid fa-list"></i>
                        Departaments
                    </h5>
                    <button>
                        <i class="fa-solid fa-plus"></i>
                        Add Departament
                    </button>
                </div>
                <div class="categories-tables-body">
                    <table class="categories-table">
                        <thead>
                            <tr>
                                <th>name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Administration</td>
                                <td>
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Finance</td>
                                <td>
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>General</td>
                                <td>
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="categories-tables">
                <div class="categories-tables-head">
                    <h5>
                        <i class="fa-solid fa-list"></i>
                        Departaments
                    </h5>
                    <button>
                        <i class="fa-solid fa-plus"></i>
                        Add Departament
                    </button>
                </div>
                <div class="categories-tables-body">
                    <table class="categories-table">
                        <thead>
                            <tr>
                                <th>name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Administration</td>
                                <td>
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Finance</td>
                                <td>
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>General</td>
                                <td>
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="categories-tables">
                <div class="categories-tables-head">
                    <h5>
                        <i class="fa-solid fa-list"></i>
                        Departaments
                    </h5>
                    <button>
                        <i class="fa-solid fa-plus"></i>
                        Add Departament
                    </button>
                </div>
                <div class="categories-tables-body">
                    <table class="categories-table">
                        <thead>
                            <tr>
                                <th>name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Administration</td>
                                <td>
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Finance</td>
                                <td>
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>General</td>
                                <td>
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


        <?php include '../template/footer.php'; ?>
    </div>

</body>

</html>