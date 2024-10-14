<?php
require_once '../config.php';

session_start();
$userId = $_SESSION['user_id'];

$sql = "SELECT u.user_id, u.image from users u where user_id=$userId";

$prep = $con->prepare($sql);
$prep->execute();
$userImages = $prep->fetchAll();

$adressquery = "SELECT * from adress a where user_id=$userId";

$prep = $con->prepare($adressquery);
$prep->execute();
$addresses = $prep->fetchAll();

$contactquery = "SELECT * from contact a where user_id=$userId";

$prep = $con->prepare($contactquery);
$prep->execute();
$contacts = $prep->fetchAll();

include 'imgLogic.php';






?>

<head>
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
    <link rel="stylesheet" href="../css/myprofile.css">
    <script src="../js/dropdown.js"></script>
</head>

<body>
    <div>
        <?php include '../template/sidebar.php' ?>

    </div>
    <div id="main">
        <?php include '../template/navbar.php' ?>
        <div class="name">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>
        <div class="row">
            <h3 id="well_1">Your Profile Data</h3>
            <div id="well">
                <p>This is your address and contact information that is contained within HR Partner. You may make
                    changes to this information which will be merged with the main database.</p>
            </div>
        </div>
        <div class="row">
            <div class="row_2">
                <div class="row_3">
                    <h3>
                        <i class="ff fa fa-phone  m-r-sm" Style=" color: #888888;"></i>
                        Contact Information
                    </h3>
                    <hr>
                    <div id="employeecontactlist">
                        <table>
                            <tbody>
                                <?php foreach ($contacts as $contact): ?>
                                    <tr>
                                        <td>
                                            <?php if ($contact['contact_type'] === 'Email') { ?>
                                                <i class="fa-solid fa-envelope"></i>
                                            <?php } elseif ($contact['contact_type'] === 'Google+') { ?>
                                                <i class="fa-brands fa-google-plus-g"></i>
                                            <?php } else { ?>
                                                <i class="fa-brands fa-<?= $contact['contact_type'] ?>"></i>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="<?= $contact['details'] ?>">
                                                <?= $contact['details'] ?> &nbsp;
                                            </a>
                                            <?php if ($contact['primary_contact'] == 1): ?>
                                                <i class="fa fa-star text-warning"></i>
                                            <?php endif ?>
                                        </td>
                                        <td class="options">
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#edit_contact_modal<?= $contact['contact_id'] ?>"
                                                data-bs-whatever="@mdo"><i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="./addContactLogic.php" method="post">
                                                <input type="hidden" value="<?= $contact['contact_id'] ?>" name="contact_id"
                                                    id="">
                                                <?php if ($contact['primary_contact'] == 1) {
                                                    ?>
                                                    <button type="submit" name="removePrimary">
                                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                    </button>
                                                <?php } else { ?>
                                                    <button type="submit" name="makePrimary">
                                                        <i class="fa-regular fa-star" style="color: #FFD43B;"></i>
                                                    </button>
                                                <?php } ?>
                                            </form>
                                            <form action="./addContactLogic.php" method="post">
                                                <input type="hidden" value="<?= $contact['contact_id'] ?>" name="contact_id"
                                                    id="">
                                                <?php if ($contact['public'] == 1) {
                                                    ?>
                                                    <button type="submit" name="removePublic">
                                                        <i class="fa fa-globe m-r-sm" style="color: #2126b5;"></i>
                                                    </button>
                                                <?php } else { ?>
                                                    <button type="submit" name="makePublic">
                                                        <i class="fa fa-globe m-r-sm" style="color: #2126b5;"></i>
                                                    </button>
                                                <?php } ?>
                                            </form>
                                            <button type="submit" name="deleteContact">
                                                <a href="deleteContact.php?contact_id=<?= $contact['contact_id'] ?>"> <i
                                                        class="fa-solid fa-trash-can" style="color: #d20f0f;"></i></a>
                                            </button>
                                        </td>
                                        <div class="modal fade" id="edit_contact_modal<?= $contact['contact_id'] ?>"
                                            tabindex="-1" aria-labelledby="edit_contact_modal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop" style="width: 580px;">
                                                    <form action="./addContactLogic.php" method="post">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="edit_contact_modal">Add
                                                                Contact</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="form-group">
                                                                <input type="hidden" name="contact_id"
                                                                    value="<?= $contact['contact_id'] ?>">
                                                                <label>Contact Type</label>
                                                                <select class="contacttypelist_chosen" name="contact_type">
                                                                    <option value="<?= $contact['contact_type'] ?>">
                                                                        <?= $contact['contact_type'] ?>
                                                                    </option>
                                                                    <option value="Phone">Phone</option>
                                                                    <option value="Email">Email</option>
                                                                    <option value="Mobile">Mobile</option>
                                                                    <option value="Fax">Fax</option>
                                                                    <option value="Pager">Pager</option>
                                                                    <option value="Facebook">Facebook</option>
                                                                    <option value="Twitter">Twitter</option>
                                                                    <option value="Google+">Google+</option>
                                                                    <option value="Linkedin">Linkedin</option>
                                                                    <option value="Skype">Skype</option>
                                                                    <option value="Instagram">Instagram</option>
                                                                    <option value="Github">Github</option>
                                                                    <option value="WhatsApp">WhatsApp</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Details</label>
                                                                <input type="text" name="details" id=""
                                                                    value="<?= $contact['details'] ?>" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>
                                                                    <?php if ($contact['primary_contact'] == 1) { ?>
                                                                        <input checked type="checkbox" name="primary_contact"
                                                                            id="" value="1">
                                                                    <?php } else { ?>
                                                                        <input type="checkbox" name="primary_contact" id=""
                                                                            value="1"><?php } ?>

                                                                    This is a primary contact address (for automatic
                                                                    mailouts etc.)
                                                                </label>
                                                                <label>
                                                                    <?php if ($contact['public'] == 1) { ?>
                                                                        <input checked type="checkbox" name="public" id=""
                                                                            value="1">
                                                                    <?php } else { ?>
                                                                        <input type="checkbox" name="public" id=""
                                                                            value="1"><?php } ?>
                                                                    Show this contact on the public employee directory
                                                                </label>
                                                                <label>
                                                                    <?php if ($contact['emergency'] == 1) { ?>
                                                                        <input checked type="checkbox" name="emergency" id=""
                                                                            value="1">
                                                                    <?php } else { ?>
                                                                        <input type="checkbox" name="emergency" id=""
                                                                            value="1"><?php } ?>
                                                                    This is an emergency contact point
                                                                </label>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Extra information</label>
                                                                <label style="display:none;">Name and Relationship to
                                                                    employee</label>
                                                                <input type="text" name="extra_info" id=""
                                                                    value="<?= $contact['extra_info'] ?>"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn bg-secondary text-light"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="editContact"
                                                                class="btn bg-success text-light">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <button id="add_new_contact" class="add_new_contact" data-bs-toggle="modal"
                        data-bs-target="#add_new_contact_modal" data-bs-whatever="@mdo">Add New Contact</button>
                    <div class="modal fade" id="add_new_contact_modal" tabindex="-1"
                        aria-labelledby="add_new_contact_modal_Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated slideInTop" style="width: 580px;">
                                <form action="./addContactLogic.php" method="post">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="add_new_contact_modal_Label">Add Contact</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label>Contact Type</label>
                                            <select class="contacttypelist_chosen" name="contact_type">
                                                <option value="Phone">Phone</option>
                                                <option value="Email">Email</option>
                                                <option value="Mobile">Mobile</option>
                                                <option value="Fax">Fax</option>
                                                <option value="Pager">Pager</option>
                                                <option value="Facebook">Facebook</option>
                                                <option value="Twitter">Twitter</option>
                                                <option value="Google+">Google+</option>
                                                <option value="Linkedin">Linkedin</option>
                                                <option value="Skype">Skype</option>
                                                <option value="Instagram">Instagram</option>
                                                <option value="Github">Github</option>
                                                <option value="WhatsApp">WhatsApp</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Details</label>
                                            <input type="text" name="details" id="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" name="primary_contact" id="" value="1">
                                                This is a primary contact address (for automatic mailouts etc.)
                                            </label>
                                            <label>
                                                <input type="checkbox" name="public" id="" value="1">
                                                Show this contact on the public employee directory
                                            </label>
                                            <label>
                                                <input type="checkbox" name="emergency" id="" value="1">
                                                This is an emergency contact point
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>Extra information</label>
                                            <label style="display:none;">Name and Relationship to employee</label>
                                            <input type="text" name="extra_info" id="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="cancel" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="saveContact" class="save">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <p class="small">
                        Note: Making a contact your 'Primary' means that the system can send
                        you important automatic information on that contact address.
                        Making your contact 'Public' means that it will show on the employee
                        directory for other employees to see and use to contact you.
                    </p>
                </div>

                <div class="row_3">
                    <h3>
                        <i class="ff fa fa-map-marker text-muted m-r-sm"></i>
                        Address Information
                    </h3>
                    <div id="employeeaddresslist">

                        <?php if (count($addresses) === 0) { ?>
                            <p>There are no addresses yet entered for you. Press the 'Add New Address' button below to start
                                adding them.</p>



                        <?php } elseif (count($addresses) > 0) { ?>

                            <?php foreach ($addresses as $address) { ?>
                                <div class="addresElements">
                                    <?php if ($address['address_type'] === "Home") { ?>
                                        <i class="fa fa-2x fa-house"></i>
                                    <?php } ?>
                                    <?php if ($address['address_type'] === "Visiting") { ?>
                                        <i class="fa fa-2x fa-road"></i>
                                    <?php } ?>
                                    <?php if ($address['address_type'] === "Previous") { ?>
                                        <i class="fa fa-2x fa-map-signs"></i>
                                    <?php } ?>
                                    <?php if ($address['address_type'] === "Work") { ?>
                                        <i class="fa fa-2x fa-inbox"></i>
                                    <?php } ?>
                                    <?php if ($address['address_type'] === "Postal") { ?>
                                        <i class="fa fa-regular fa-envelope"></i>
                                    <?php } ?>
                                    <?php if ($address['address_type'] === "Delivery") { ?>
                                        <i class="fa fa-solid fa-truck fa-flip-horizontal"></i>
                                    <?php } ?>
                                    <?php if ($address['address_type'] === "Next Of Kin") { ?>
                                        <i class="fa fa-solid fa-person"></i>
                                    <?php } ?>



                                    <div class="address">
                                        <h4><?= $address['address_type'] ?>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#edit_address_modal<?= $address['adress_id'] ?>"
                                                data-bs-whatever="@mdo"><i class="fa-regular fa-pen-to-square"></i>
                                                Edit</a>
                                            <a href="deleteAddress.php?adress_id=<?= $address['adress_id'] ?>"> <i
                                                    class="fa-solid fa-trash-can"></i>
                                                Delete</a>
                                        </h4>
                                        <div class="modal fade" id="edit_address_modal<?= $address['adress_id'] ?>"
                                            tabindex="-1" aria-labelledby="edit_address_modal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated slideInTop" style="width: 580px;">
                                                    <form action="./addAddresLogic.php" method="post">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="edit_address_modal">Add Address
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="form-group">
                                                                <label>Address Type</label>
                                                                <input type="hidden" name="adress_id" id=""
                                                                    value="<?= $address['adress_id'] ?>">
                                                                <select class="addresstypelist_chosen" name="address_type">
                                                                    <option value="<?= $address['address_type'] ?>">
                                                                        <?= $address['address_type'] ?>
                                                                    </option>
                                                                    <option value="Home">Home</option>
                                                                    <option value="Postal">Postal</option>
                                                                    <option value="Work">Work</option>
                                                                    <option value="Delivery">Delivery</option>
                                                                    <option value="Next Of Kin">Next Of Kin</option>
                                                                    <option value="Visiting">Visiting</option>
                                                                    <option value="Previous">Previous</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address Line 1</label>
                                                                <input type="text" id="address_line_1" name="address_line_1"
                                                                    class="form-control"
                                                                    value="<?= $address['address_line_1'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address Line 2 (Optional)</label>
                                                                <input type="text" name="address_line_2" id=""
                                                                    class="form-control"
                                                                    value="<?= $address['address_line_2'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Suburb/Town/City</label>
                                                                <input type="text" name="city" id="" class="form-control"
                                                                    value="<?= $address['city'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>State/County</label>
                                                                <input type="text" name="state" id="" class="form-control"
                                                                    value="<?= $address['state'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Postal/Zip Code</label>
                                                                <input type="number" name="zip_code" id="" class="form-control"
                                                                    value="<?= $address['zip_code'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Countruy</label>
                                                                <select class="countrylist_chosen" name="country">
                                                                    <option value="<?= $address['country'] ?>">
                                                                        <?= $address['country'] ?>
                                                                    </option>
                                                                    <option value="Albania">Albania</option>
                                                                    <option value="Kosovo">Kosovo</option>

                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn bg-secondary text-light"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="editAdress"
                                                                class="btn bg-success text-light">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <Strong><?= $address['address_line_1'] ?></Strong>
                                        <p><?= $address['address_line_2'] ?></p>
                                        <p><?= $address['city'] ?><?= $address['state'] ?><?= $address['zip_code'] ?></p>
                                        <p><small><?= $address['country'] ?></small></p>

                                    </div>
                                </div>
                            <?php } ?>


                        <?php } ?>
                    </div>
                    <button id="add_new_address" class="add_new_address" data-bs-toggle="modal"
                        data-bs-target="#add_new_address_modal" data-bs-whatever="@mdo">Add New Contact</button>
                    <div class="modal fade" id="add_new_address_modal" tabindex="-1"
                        aria-labelledby="add_new_address_modal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated slideInTop" style="width: 580px;">
                                <form action="./addAddresLogic.php" method="post">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="add_new_address_modal">Add Address</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label>Address Type</label>
                                            <select class="addresstypelist_chosen" name="address_type">
                                                <option value="Home">Home</option>
                                                <option value="Postal">Postal</option>
                                                <option value="Work">Work</option>
                                                <option value="Delivery">Delivery</option>
                                                <option value="Next Of Kin">Next Of Kin</option>
                                                <option value="Visiting">Visiting</option>
                                                <option value="Previous">Previous</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Address Line 1</label>
                                            <input type="text" id="address_line_1" name="address_line_1"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Address Line 2 (Optional)</label>
                                            <input type="text" name="address_line_2" id="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Suburb/Town/City</label>
                                            <input type="text" name="city" id="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>State/County</label>
                                            <input type="text" name="state" id="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Postal/Zip Code</label>
                                            <input type="number" name="zip_code" id="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Countruy</label>
                                            <select class="countrylist_chosen" name="country">
                                                <option value="Albania">Albania</option>
                                                <option value="Kosovo">Kosovo</option>

                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="cancel" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="addAdress" class="save">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="profileImage">
                <div id="profileimgHeader">
                    <h5>Profile Image</h5>
                </div>
                <div id="profileimgBody">
                    <form action="" method="POST" enctype="multipart/form-data">

                        <label for="profileIMG">
                            <?php foreach ($userImages as $userImage): ?>
                                <img src="../userIMG/<?= $userImage['image'] ?>" alt="" width="120px" height="120px">
                            <?php endforeach; ?>
                        </label>
                        <input type="file" name="image" id="profileIMG">
                        <div>
                            <small>
                                Click on the image above, or drag and drop a new one on top, in order to update the
                                profile
                                picture for your account (
                                <strong>220 x 220px</strong>
                                size recommended. Limit
                                <strong>5MB.</strong>
                                ).
                            </small>


                            <button type="submit" name="saveimg">Save</button>
                        </div>
                    </form>


                </div>

            </div>
        </div>
        <div class="row">
            <div id="passchangehead">
                <h5>Password</h5>
            </div>
            <div id="passchange">
                <form action="" method="POST">
                    <div class="form-group2">
                        <label for="password">Old Password</label>
                        <input type="password" name="password" class="password" value="<?php echo $currentPass ?>">
                        <div class="red-text"><?php echo $errors['old_pass'] ?></div>
                    </div>
                    <div class="form-group2">
                        <label for="newpassword">New Password</label>
                        <input type="password" name="newpassword" class="password" value="<?php echo $newpassword ?>">
                        <div class="red-text"><?php echo $errors['new_pass'] ?></div>
                    </div>
                    <div class="form-group2">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" name="confirmpassword" class="password"
                            value="<?php echo $confirmpassword ?>">
                        <div class="red-text"><?php echo $errors['confirm_pass'] ?></div>
                        <div id="savepass">
                            <button type="submit" name="savepass" id="savepass1">Save</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <?php include '../template/footer.php'; ?>
    </div>

</body>

</html>