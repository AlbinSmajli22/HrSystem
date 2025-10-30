<?php
include './companyInfoLogic.php';
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
        <?php include '../template/adminSidebar.php' ?>
    </div>
    <div class="content">
        <?php include '../template/navbar.php' ?>

        <div class="companyName">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="editCompany_CompanyLogo">
                <div class="editCompany">
                    <div class="editCompanyHead">
                        <h5>Edit Company Details</h5>
                    </div>
                    <div class="editCompanyBody">

                        <label for="companyName">Company Name</label>
                        <input type="text" name="companyName" id="" value="<?=$companyInfo['company_name'] ?>">

                        <label for="subcribedUntil">Subscribed Until</label>
                        <input type="date" name="subcribedUntil" id="subcribed" readonly value="<?=$companyInfo['subscribed_until'] ?>">

                        <label for="maxEmp">Max. Employees</label>
                        <input type="text" name="maxEmp" id="empMax" readonly value="<?=$companyInfo['emp_num'] ?>">

                        <hr>
                        <span>Locale</span>

                        <label for="country">Country That Your Company is in</label>
                        <select name="CompCountry" id="country" class="country">
                        </select>
                        <p>This wil et up the country specific formatting for your company.</p>

                        <label for="timezone">Your Company Timezone</label>
                        <select name="timezone" id="timezone" class="timezone">
                        </select>
                        <p>Pic the closest timezone applicable for your company (Note: Users default to this, but can
                            choose their own later).</p>
                        <hr>
                        <div class="buttons">
                            <button type="submit" name="saveCompData" id="save">Save</button>
                            <a href="" id="cancel">Cancel</a>
                        </div>


                    </div>

                </div>
                <div class="CompanyLogo">
                    <div class="CompanyLogoHead">
                        <h5>Company Logo</h5>
                    </div>
                    <div class="CompanyLogoBody">
                        <span id="logoArea">Drag your company logo image here.</span>
                        <input type="file" name="image" id="logo">
                        <small>
                            Click on the box above, or drag and drop a new image into the box, in order to update the logo
                            for your company ( <strong>220px</strong> maximum height recommended. Limit <strong>5MB</strong>. ).
                        </small>
                    </div>
                </div>
            </div>
        </form>

        <?php include '../template/footer.php' ?>
    </div>
    <script>
    window.appSettings = {
        selectedCountry: "<?= addslashes($selectedCountry) ?>",
        selectedTimezone: "<?= addslashes($selectedTimezone) ?>"
    };
</script>
<script src="../js/companyInfo.js" type="text/javascript"></script>
</body>

</html>