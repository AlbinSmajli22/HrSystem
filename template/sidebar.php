<?php $sql = "SELECT u.user_id, u.image from users u where user_id=$userId";
$prep = $con->prepare($sql);
$prep->execute();
$userImages = $prep->fetchAll();
$userName=$_SESSION['name'];
?>

<head>
    <link rel="stylesheet" href="../css/index.css">
    <script src="../js/index.js"></script>
</head>
<div id="sidebar">
    <ul id="sidebarElements">
        <li id="profile">
            <div class="profile-element">
                <span class="profile-element-image">
                    <?php foreach ($userImages as $userImage): ?>
                        <img src="../userIMG/<?= $userImage['image'] ?>" alt="">
                    <?php endforeach; ?>
                </span>
                <span class="profile-element-name">
                    <strong><?= $userName ?></strong>
                </span>
            </div>
            <div class="logo-element">HR</div>
        </li>
        <li class="<?= basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : '' ?>">
            <a href="home.php">
                <i class="fa-solid fa-house-chimney"></i>
                <span>Home</span>
            </a>
        </li>
        <li class="<?= basename($_SERVER['PHP_SELF']) == 'myProfile.php' ? 'active' : '' ?>">
            <a href="myProfile.php">
                <i class="fa-solid fa-user"></i>
                <span>My Profile</span>
            </a>
        </li>
        <li class="<?= basename($_SERVER['PHP_SELF']) == 'directory.php' ? 'active' : '' ?>">
            <a href="directory.php">
                <i class="fa-solid fa-list"></i>
                <span>Directory</span>
            </a>
        </li>
        <li class="<?= basename($_SERVER['PHP_SELF']) == 'orgChart.php' ? 'active' : '' ?>">
            <a href="orgChart.php">
                <i class="fa-solid fa-sitemap"></i>
                <span>Org. Chart</span>
            </a>
        </li>
        <li class="<?= basename($_SERVER['PHP_SELF']) == 'calendar.php' ? 'active' : '' ?>">
            <a href="calendar.php">
                <i class="fa-regular fa-calendar-days"></i>
                <span>Calendar</span>
            </a>
        </li>
        <?php if ($_SESSION['role'] == 0) { ?>
            <li Style="cursor: pointer;" onclick="toggleDropdown(this)">
                <a>
                    <i class="fa fa-plane"></i>
                    <span>Time Off & Leave</span>
                    <i class="fa-solid fa-caret-right"></i>
                </a>
                <ul class="dropdown">
                    <li><a href="request.php"><i class="fa-solid fa-suitcase"></i> Request</a></li>
                    <li><a href="approverequest.php"> <i class="fa fa-calendar-check-o"></i> Approve</a></li>
                    <li><a href="requesthistory.php"><i class="fa fa-list"></i> History</a></li>
                </ul>
            </li>
        <?php } else { ?>
            <li onclick="toggleDropdown(this)">
                <a>
                    <i class="fa fa-plane"></i>
                    <span>Time Off & Leave</span>
                    <i class="fa-solid fa-caret-right"></i>
                </a>

                <ul class="dropdown">
                    <li>
                        <a href="planer.php">
                            <i class="fa-regular fa-calendar-days"></i> 
                            <span>Planer</span>
                        </a>
                    </li>
                    <li>
                        <a href="approverequest.php"> 
                            <i class="fa fa-plane"></i> 
                            <span>Requests</span>
                        </a>
                    </li>
                    <li>
                        <a href="availability.php">
                            <i class="fa-solid fa-rectangle-list"></i>
                            <span> Availability</span>
                        </a>
                    </li>
                    <li class="menu-item nested" onclick="toggleDropdown(this, event)">
                        <a>
                            <i class="fa-solid fa-pencil"></i>
                            <span>Bulk Update</span>
                            <i class="fa-solid fa-caret-right"></i>
                        </a>

                        <ul class="dropdown">
                            <li><a href="balances.php"><i class="fa-solid fa-calculator"></i> <span>Balances</span></a></li>
                            <li><a href="allowance.php"><i class="fa-solid fa-hourglass-half"></i>
                                    <span>Allowances</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="configureLeaves.php">
                            <i class="fa-solid fa-gear"></i> 
                            <span>Configure</span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <?php if ($_SESSION['role'] == 0) { ?>
                <li Style="cursor: pointer;" class="<?= basename($_SERVER['PHP_SELF']) == 'calendar.php' ? 'active' : '' ?>">
                    <a href="empexpenses.php">
                        <i class="fa-solid fa-money-bill-1-wave"></i>
                        <span>Expenses</span>
                    </a>
                </li>
            <?php } else { ?>
                <li Style="cursor: pointer;" onclick="toggleDropdown(this)">
                    <a>
                        <i class="fa-solid fa-money-bill-1-wave"></i>
                        <span>Expenses</span>
                        <i class="fa-solid fa-caret-right"></i>
                    </a>

                    <ul class="dropdown">
                        <li>
                            <a href="expenses.php">
                                <i class="fa-regular fa-square-check"></i> 
                                <span>Expenses</span>
                            </a>
                        </li>
                        <li>
                            <a href="configureExpenses.php"> 
                                <i class="fa-solid fa-gear"></i> 
                                <span>Configure</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            <?php if ($_SESSION['role'] == 0) { ?>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'calendar.php' ? 'active' : '' ?>">
                    <a href="goals.php">
                        <i class="fa-solid fa-bullseye"></i>
                        <span>Goals</span>
                    </a>
                </li>
            <?php } else { ?>
                <li Style="cursor: pointer;" onclick="toggleDropdown(this)">
                    <a>
                        <i class="fa-solid fa-bullseye"></i> 
                        <span>Goals</span> 
                        <i class="fa-solid fa-caret-right"></i>
                    </a>
                    <ul id="goalsConfigure" class="dropdown">
                        <li>
                            <a href="assignesGoals.php">
                                <i class="fa-regular fa-square-check"></i>
                                <span>Assigned</span>
                            </a>
                        </li>
                        <li class="menu-item nested" onclick="toggleDropdown(this, event)">
                            <a>
                                <i class="fa-solid fa-gear"></i> 
                                <span>Configure</span> 
                                <i class="fa-solid fa-caret-right"></i>
                            </a>
                            <ul class="dropdown">
                                <li>
                                    <a href="template.php"> 
                                        <i class="fa-regular fa-file-code"></i> 
                                        <span>Templates</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="goalItem.php">
                                        <i class="fa-solid fa-list"></i> 
                                        <span>Goal Items</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            <li class="<?= basename($_SERVER['PHP_SELF']) == 'library.php' ? 'active' : '' ?>">
                <a href="library.php"> 
                    <i class="fa-solid fa-book"></i>
                    <span>Library</span>
                </a>
            </li>
            <?php if ($_SESSION['role'] == 0) { ?>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'empNews.php' ? 'active' : '' ?>">
                    <a href="empNews.php">
                        <i class="fa-solid fa-newspaper"></i>
                        <span>News</span>
                    </a>
                </li>
            <?php } else { ?>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'news.php' ? 'active' : '' ?>">
                    <a href="news.php">
                        <i class="fa-solid fa-newspaper"></i>
                        <span>News</span>
                    </a>
                </li>
        <?php } ?>
        <?php if ($_SESSION['role'] == 0) { ?>
            <li class="<?= basename($_SERVER['PHP_SELF']) == 'pinboard.php' ? 'active' : '' ?>">
                <a href="pinboard.php">
                    <i class="fa-solid fa-thumbtack"></i>
                    <span>Pinboard</span>
                </a>
            </li>
        <?php } ?>
        <?php if ($_SESSION['role'] == 1) { ?>
            <li>
                <a href="setup.php">
                    <i class="fa-solid fa-wrench"></i>
                    <span>Setup</span>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>