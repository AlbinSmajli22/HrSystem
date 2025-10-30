<?php

include './listsLogic.php';

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/lists.css">
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
        <?php include '../template/adminSidebar.php' ?>
    </div>
    <div class="content">
        <?php include '../template/navbar.php' ?>
        <div class="authUserHead">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>
        <div id="well">
            <p>These are the various look up lists that are used when entering other data aginst your employees (i.e. training types, documents etc.).
                It is highly recommended that you set these up before you begin creating or importing employees.
            </p>
            <p>You can change them later, but pleasa be aware that this will affect all employees already in the
                system, so pleae be carefully.
            </p>
        </div>
        <div class="lists">

            <div class="lists-left">
                <div class="lists-tables">
                    <div class="lists-tables-head">
                        <h5>
                            <i class="fa-solid fa-list"></i>
                            Absence Statuses
                        </h5>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addAbsenceStatusModal"
                            data-bs-whatever="@mdo">
                            <i class="fa-solid fa-plus"></i>
                            Absence Status
                        </button>
                        <div class="modal fade-add-AbsenceStatusModal" id="addAbsenceStatusModal" tabindex="-1"
                            aria-labelledby="addAbsenceStatusModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated slideInTop">
                                    <form action="listsLogic.php" method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">×</button>
                                            <h4 class="modal-title" id="exampleModalLabel">Add Absence Status</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="beginning-part">
                                                <div class="inputs">
                                                    <label for="absence">Absence Status Name</label>
                                                    <input type="text" name="absence" id="absence">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-exit"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addAbsenceStatus" class="btn-save">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lists-tables-body">
                        <?php if (empty($absenceStatuses)) { ?>
                            <p class="NoData"><i> (No data) </i></p>
                        <?php } else { ?>
                        <table class="lists-table">
                            <thead>
                                <tr>
                                    <th>name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($absenceStatuses as $absenceStatus): ?>
                                    <tr>
                                        <td><?= $absenceStatus['absencestatus_name'] ?></td>
                                        <td>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#editAbsenceStatusModal<?= $absenceStatus['absencestatus_id'] ?>"
                                                data-bs-whatever="@mdo" class="editList"> <i class="fa fa-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#deleteAbsenceStatusModal<?= $absenceStatus['absencestatus_id'] ?>"
                                                data-bs-whatever="@mdo" class="deleteList"><i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <div class="modal fade-delete-AbsenceStatusModal"
                                            id="deleteAbsenceStatusModal<?= $absenceStatus['absencestatus_id'] ?>" tabindex="-1"
                                            aria-labelledby="deleteAbsenceStatusModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <div class="modal-header-delete">
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">×</button>
                                                        <h6 class="modal-title" id="exampleModalLabel">Delete Absence Status</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="delete-part-two">

                                                            <p>This will delete this item: <span>
                                                                    <?= $absenceStatus['absencestatus_name'] ?> </span> </p>
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
                                                        <a href="listsLogic.php?absencestatus_id=<?= $absenceStatus['absencestatus_id'] ?>"
                                                            class="deleteButton">delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade-edit-AbsenceStatusModal"
                                            id="editAbsenceStatusModal<?= $absenceStatus['absencestatus_id'] ?>" tabindex="-1"
                                            aria-labelledby="editAbsenceStatusModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <form action="listsLogic.php" method="post">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">×</button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Edit Absence Status
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="beginning-part">
                                                                <div class="inputs">
                                                                    <input type="hidden" name="absencestatus_id" id=""
                                                                        value="<?= $absenceStatus['absencestatus_id'] ?>">
                                                                    <label for="absence">Absence Status Name</label>
                                                                    <input type="text" name="absence" id="absence"
                                                                        value="<?= $absenceStatus['absencestatus_name'] ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn-exit"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="editAbsenceStatus"
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
                        <?php } ?>
                    </div>
                    
                </div>
                <div class="lists-tables">
                    <div class="lists-tables-head">
                        <h5>
                            <i class="fa-solid fa-list"></i>
                            Asset Types
                        </h5>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addAssetTypeModal"
                            data-bs-whatever="@mdo">
                            <i class="fa-solid fa-plus"></i>
                            Asset Type
                        </button>
                        <div class="modal fade-add-AssetTypeModal" id="addAssetTypeModal" tabindex="-1"
                            aria-labelledby="addAssetTypeModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated slideInTop">
                                    <form action="listsLogic.php" method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">×</button>
                                            <h4 class="modal-title" id="exampleModalLabel">Add Asset Type</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="beginning-part">
                                                <div class="inputs">
                                                    <label for="asset">Asset Type Name</label>
                                                    <input type="text" name="asset" id="asset">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-exit"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addAssetType" class="btn-save">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lists-tables-body">
                        <?php if (empty($assetTypes)) { ?>
                            <p class="NoData"><i> (No data) </i></p>
                        <?php } else { ?>
                        <table class="lists-table">
                            <thead>
                                <tr>
                                    <th>name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($assetTypes as $assetType): ?>
                                    <tr>
                                        <td><?= $assetType['assettype_name'] ?></td>
                                        <td>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#editAssetTypeModal<?= $assetType['assettype_id'] ?>"
                                                data-bs-whatever="@mdo" class="editList"> <i class="fa fa-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#deleteAssetTypeModal<?= $assetType['assettype_id'] ?>"
                                                data-bs-whatever="@mdo" class="deleteList"> <i
                                                    class="fa fa-trash"></i></a>
                                        </td>
                                        <div class="modal fade-delete-AssetTypeModal"
                                            id="deleteAssetTypeModal<?= $assetType['assettype_id'] ?>" tabindex="-1"
                                            aria-labelledby="deleteAssetTypeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <div class="modal-header-delete">
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">×</button>
                                                        <h6 class="modal-title" id="exampleModalLabel">Delete Asset Type</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="delete-part-two">

                                                            <p>This will delete this item: <span>
                                                                    <?= $assetType['assettype_name'] ?> </span> </p>
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
                                                        <a href="listsLogic.php?assettype_id=<?= $assetType['assettype_id'] ?>"
                                                            class="deleteButton">delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade-edit-AssetTypeModal"
                                            id="editAssetTypeModal<?= $assetType['assettype_id'] ?>" tabindex="-1"
                                            aria-labelledby="editAssetTypeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <form action="listsLogic.php" method="post"
                                                        enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">×</button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Edit Asset Type
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="beginning-part">
                                                                <div class="inputs">
                                                                    <input type="hidden" name="assettype_id" id="assettype_id"
                                                                        value="<?= $assetType['assettype_id'] ?>">
                                                                    <label for="asset">Asset Type Name</label>
                                                                    <input type="text" name="asset" id="asset"
                                                                        value="<?= $assetType['assettype_name'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn-exit"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="editAssetType"
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
                        <?php } ?>  
                    </div>
                </div>
                
            </div>
            <div class="lists-right">
                <div class="lists-tables">
                    <div class="lists-tables-head">
                        <h5>
                            <i class="fa-solid fa-list"></i>
                            Pay Levels
                        </h5>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addPayLevelModal"
                            data-bs-whatever="@mdo">
                            <i class="fa-solid fa-plus"></i>
                            Add Pay Level
                        </button>
                        <div class="modal fade-add-PayLevelModal" id="addPayLevelModal" tabindex="-1"
                            aria-labelledby="addPayLevelModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated slideInTop">
                                    <form action="listsLogic.php" method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">×</button>
                                            <h4 class="modal-title" id="exampleModalLabel">Add Pay Level</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="beginning-part">
                                                <div class="inputs">
                                                    <label for="level">Pay Level Name</label>
                                                    <input type="text" name="level" id="level">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-exit"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addPayLevel" class="btn-save">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lists-tables-body">
                         <?php if (empty($payLevels)) { ?>
                            <p class="NoData"><i> (No data) </i></p>
                        <?php } else { ?>
                        <table class="lists-table">
                            <thead>
                                <tr>
                                    <th>name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($payLevels as $payLevel): ?>
                                    <tr>
                                        <td><?= $payLevel['paylevel_name'] ?></td>
                                        <td>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#editPayLevelModal<?= $payLevel['paylevel_id'] ?>"
                                                data-bs-whatever="@mdo" class="editList"> <i class="fa fa-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#deletePayLevelModal<?= $payLevel['paylevel_id'] ?>"
                                                data-bs-whatever="@mdo" class="deleteList"> <i
                                                    class="fa fa-trash"></i></a>
                                        </td>
                                        <div class="modal fade-delete-PayLevelModal"
                                            id="deletePayLevelModal<?= $payLevel['paylevel_id'] ?>" tabindex="-1"
                                            aria-labelledby="deletePayLevelModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <div class="modal-header-delete">
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">×</button>
                                                        <h6 class="modal-title" id="exampleModalLabel">Delete Pay Level</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="delete-part-two">

                                                            <p>This will delete this item: <span>
                                                                    <?= $payLevel['paylevel_name'] ?> </span> </p>
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
                                                        <a href="listsLogic.php?paylevel_id=<?= $payLevel['paylevel_id'] ?>"
                                                            class="deleteButton">delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade-edit-PayLevelModal"
                                            id="editPayLevelModal<?= $payLevel['paylevel_id'] ?>" tabindex="-1"
                                            aria-labelledby="editPayLevelModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop">
                                                    <form action="listsLogic.php" method="post"
                                                        enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">×</button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Edit Pay Level
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="beginning-part">
                                                                <div class="inputs">
                                                                    <input type="hidden" name="paylevel_id" id=""
                                                                        value="<?= $payLevel['paylevel_id'] ?>">
                                                                    <label for="level">Departament Name</label>
                                                                    <input type="text" name="level" id="level"
                                                                        value="<?= $payLevel['paylevel_name'] ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn-exit"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="editPayLevel"
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
                        <?php } ?>
                    </div>
                    
                </div>

                

            </div>


        </div>


        <?php include '../template/footer.php'; ?>
    </div>

</body>

</html>