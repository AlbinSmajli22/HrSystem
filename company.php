<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="css/company.css">
</head>
<?php include 'registrecompany.php'; ?>
<body>
    <div id="content">
        <div id="logo">
            <img src="images/hrpartner.png" alt="">
        </div>
       
        <div id="info">
            <img src="images/view_all_employees1.png" alt="" width="64px">
            <h3>
                Nearly there!
            </h3>
            <p>We just need a few more details to create your HR Partner account and begin your journey right now.</p>
        </div>
        <div id="registration">
            <div id="data">
                <form action="" method="post">
                    <h4>Free Trial - No Credit Card Required</h4>
                    <h4 class="error" Style="color:red;"><?php echo $errors['companyExist'] ?></h4>
                    <p class="error" Style="color:red;"><?php echo $errors['mailError'] ?></p>
                    <div class="datarow">
                        <input type="email" name="email" id="email" class="inputdata" placeholder="Email">
                    </div>
                    <div id="fullname">
                        <input type="text" name="name" id="name" class="nameinput" placeholder="First Name">
                        <input type="text" name="surname" id="lastname" class="nameinput" placeholder="Last Name">
                    </div>
                    <div class="datarow">
                        <input type="password" name="password" id="password" class="inputdata" placeholder="Password">
                    </div>
                    <div class="datarow">
                        <input type="number" name="emp_num" id="emp_num" class="inputdata" placeholder="Number of Employes ">
                    </div>
                    <div class="datarow">
                        <input type="text" name="company_name" id="comapanyName" class="inputdata"
                            placeholder="Company Name">
                    </div>
                    <div class="datarow">
                        <button type="submit" name="registre">Start My Free Trail!</button>
                    </div>
                </form>
            </div>
            <div id="impressions">
            <img src="images/hr-image.jpg" alt="">
            </div>
        </div>
        <div id="footer">
            <small>
                <p>
                    <small>© 2024 HR Partner Software Pty Ltd</small>
                </p>
            </small>
        </div>
    </div>
</body>

</html>