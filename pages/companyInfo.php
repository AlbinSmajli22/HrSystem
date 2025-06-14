<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];

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
    <link rel="stylesheet" href="../css/companyInfo.css">

</head>

<body>
    <div>
        <?php include '../template/sidebar.php' ?>
    </div>
    <div class="content">
        <?php include '../template/navbar.php' ?>

        <div class="companyName">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>
        <div class="editCompany_CompanyLogo">
            <div class="editCompany">
                <div class="editCompanyHead">
                    <h5>Edit Company Details</h5>
                </div>
                <div class="editCompanyBody">
                    <form action="">
                        <label for="companyName">Company Name</label>
                        <input type="text" name="companyName" id="">

                        <label for="subcribedUntil">Subscribed Until</label>
                        <input type="date" name="subcribedUntil" id="">

                        <label for="maxEmp">Max. Employees</label>
                        <input type="date" name="maxEmp" id="">

                        <hr>
                        <span>Locale</span>

                        <label for="CompCountry">Country That Your Company is in</label>
                        <select name="CompCountry" id="CompCountry">
                            <option value="Albanian">Albanian</option>
                            <option value="England">England</option>
                            <option value="Germany">Germany</option>
                            <option value="Kosovo">Kosovo</option>
                            <option value="USA">USA</option>
                        </select>

                        <label for="CompCountry">Your Company Timezone</label>
                        <select name="CompCountry" id="CompCountry">
                            <option value="Europe/Belgrad">Europe/Belgrad</option>
                            <option value="Istanbul">Istanbul</option>
                            <option value="Germany">Noscow, St.Petersburg</option>
                            <option value="Kosovo">Beijing, Chongqing, Hong Kong, Urumqi</option>
                            <option value="Central America">Central America</option>
                        </select>
                        <hr>
                        <div>
                            <button type="submit" name="saveCompData">Save</button>
                            <button type="submit">Cancel</button>
                        </div>

                    </form>
                </div>

            </div>
            <div class="CompanyLogo">
                <div class="CompanyLogoHead">
                    <h5>Company Logo</h5>
                </div>
                <div class="CompanyLogoBody">

                </div>
            </div>
        </div>

        <?php include '../template/footer.php' ?>
    </div>

</body>

</html>