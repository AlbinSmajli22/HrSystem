<?php
require_once './config.php';
?>
<head>
<script src="https://kit.fontawesome.com/3d560ffcbd.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/home.css">
</head>
<body>
    <div id="main">
        <div class="name">
            <h2>MetDaan</h2>
        </div>
        <div style="height:20px;"></div>
        <div class="homeHead">
            <?php echo'<h2>'.$_SESSION['name'].'</h2>'; ?>
            <?php echo'<h4>'.$_SESSION['position'].'</h4>'; ?>
        </div>
        <div class="shortcuts">
            <div class="shortcutsHead">
                <h4>
                    <i class="fa-solid fa-star"></i>
                    Shortcuts
                </h4>
            </div>
            <div class="shortcutsBody">
                <div class="shortcutsBodyElements">
                    <img src="./images/request_leave5.png" alt="" width="48px" height="48px">
                    <h3>Request Time-Off</h3>
                </div>
                <div class="shortcutsBodyElements">
                    <img src="./images/company_directory.png" alt="" width="48px" height="48px">
                    <h3>Company Directory</h3>
                </div>
                <div class="shortcutsBodyElements">
                    <img src="./images/employee_profile.png" alt="" width="48px" height="48px">
                    <h3>My Profile</h3>
                </div>
                <div class="shortcutsBodyElements">
                    <img src="./images/fill_checklist.png" alt="" width="48px" height="48px">
                    <h3>Complete Checklist</h3>
                </div>
                <div class="shortcutsBodyElements">
                    <img src="./images/company_org_chart.png" alt="" width="48px" height="48px">
                    <h3>Company Org. Chart</h3>
                </div>
                <div class="shortcutsBodyElements">
                    <img src="./images/read_news_female.png" alt="" width="48px" height="48px">
                    <h3>News</h3>
                </div>
                <div class="shortcutsBodyElements">
                    <img src="./images/expense_claim3.png" alt="" width="48px" height="48px">
                    <h3>File an Expens Claim</h3>
                </div>
            </div>

        </div>
        <div class="thirdContainer">
            <div class="leftDiv">
                <div class="Activechecklists">
                    <div class="ActivechecklistsHead">
                        <h5>
                            <img src="./images/checklist.png" alt="" height="24px" width="24px" >
                            Active Checklists
                        </h5>
                    </div>
                    <div class="ActivechecklistsBody">
                        <p>You have 1 active checklist that needs completing.</p>
                        <div>
                            <a href="">Onboarding</a>
                            <a class="btn btn-primary btn-xs" href="">
                                <i class="fa fa-edit"></i>
                                Update
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="midDiv">

            </div>
            <div class="rightDiv">

            </div>

        </div>
    </div>
</body>
</html>