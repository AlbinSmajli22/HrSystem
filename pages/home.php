<?php
require_once './config.php';

$userId=$_SESSION['user_id'];
$annualLeave;
$childBorn;
$deathofFamilyMember;
$movingDay;
$weddingDay;
$sickLeave;

$sql="  SELECT * FROM timeoff WHERE User_ID = $userId";
$prep= $con->prepare($sql);

$prep->execute();
$data= $prep->fetch();

    $annualLeave = $data['annual_leave'];
    $childBorn = $data['child_born'];
    $deathofFamilyMember = $data['death_of_family_member'];
    $movingDay = $data['moving_day'];
    $weddingDay = $data['wedding_day'];
    $sickLeave = $data['sick_leave'];





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
    <link rel="stylesheet" href="./css/home.css">
</head>

<body>
    <div id="main">
        <div class="name">
            <h2>MetDaan</h2>
        </div>
        <div style="height:20px;"></div>
        <div class="homeHead">
            <?php echo '<h2>' . $_SESSION['name'] . '</h2>'; ?>
            <?php echo '<h4>' . $_SESSION['position'] . '</h4>'; ?>
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
                            <img src="./images/checklist.png" alt="" height="24px" width="24px">
                            Active Checklists
                        </h5>
                    </div>
                    <div class="ActivechecklistsBody">
                        <div class="ActivechecklistsNotification">
                            <p>
                                <em> You have 1 active checklist that needs completing.</em>
                            </p>
                        </div>
                        <div class="ActivechecklistsContent">
                            <div class="ActivechecklistsContent1">
                                <a style="color: #337ab7;">Onboarding</a>
                            </div>
                            <div class="ActivechecklistsContent2" style="width:220px;"></div>
                            <div class="ActivechecklistsContent3">
                                <a style="color: #fff;">
                                    <i class="fa-solid fa-pen-to-square" style="color: #fafcff;"></i>
                                    Update
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="timeOff">
                    <div class="timeOffHead">
                        <h5>
                            <img src="./images/balance.png" alt="" height="24px" width="24px">
                            Time Off/Leave Balances
                        </h5>
                    </div>
                    <div class="timeOffBody">
                        <table class="leavs">
                            <thead>
                                <tr>
                                    <td>Time Off/Leave Type</td>
                                    <td>Allowance <br> (Annual)</td>
                                    <td>Balance <br> (Accrued)</td>
                                    <td>Planned <br> (In the future)</td>
                                    <td>Available <br> (To take)</td>
                                    <td>Units</td>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td class="leavType">Annual Leave</td>
                                        <td>20.00</td>
                                        <td><?=$annualLeave?></td>
                                        <td>0.00</td>
                                        <td><?=$annualLeave?></td>
                                        <td>Days</td>
                                    </tr>
                                    <tr>
                                        <td class="leavType">Child born</td>
                                        <td>3.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td><?= $childBorn?></td>
                                        <td>Days</td>
                                    </tr>
                                    <tr>
                                        <td class="leavType">Death of Family Member</td>
                                        <td>5.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td><?= $deathofFamilyMember?><td>
                                        <td>Days</td>
                                    </tr>
                                    <tr>
                                        <td class="leavType">Moving Day</td>
                                        <td>1.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td><?= $movingDay?></td>
                                        <td>Days</td>
                                    </tr>
                                    <tr>
                                        <td class="leavType">Wedding Day</td>
                                        <td>5.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td><?= $weddingDay?></td>
                                        <td>Days</td>
                                    </tr>
                                    <tr>
                                        <td class="leavType">Sick Leave</td>
                                        <td>20.00</td>
                                        <td><?= $sickLeave?></td>
                                        <td>0.00</td>
                                        <td><?= $sickLeave?></td>
                                        <td>Days</td>
                                    </tr>
                                </tbody>
                        </table> 
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