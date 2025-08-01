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
            <a href="home.php" class="sidebarElements-links">
                <i class="fa-solid fa-house-chimney"></i>
                <span>Home</span>
            </a>
        </li>
        <li class="<?= basename($_SERVER['PHP_SELF']) == 'myProfile.php' ? 'active' : '' ?>">
            <a href="myProfile.php" class="sidebarElements-links">
                <i class="fa-solid fa-user"></i>
                <span>My Profile</span>
            </a>
        </li>
        <li class="<?= basename($_SERVER['PHP_SELF']) == 'directory.php' ? 'active' : '' ?>">
            <a href="directory.php" class="sidebarElements-links">
                <i class="fa-solid fa-list"></i>
                <span>Directory</span>
            </a>
        </li>
        <li class="<?= basename($_SERVER['PHP_SELF']) == 'orgChart.php' ? 'active' : '' ?>">
            <a href="orgChart.php" class="sidebarElements-links">
                <i class="fa-solid fa-sitemap"></i>
                <span>Org. Chart</span>
            </a>
        </li>
        <li class="<?= basename($_SERVER['PHP_SELF']) == 'userCalendar.php' ? 'active' : '' ?>">
            <a href="userCalendar.php" class="sidebarElements-links">
                <i class="fa-regular fa-calendar-days"></i>
                <span>Calendar</span>
            </a>
        </li>
        <?php if ($_SESSION['role'] == 0) { ?>
            <li Style="cursor: pointer;" onclick="toggleDropdown(this)">
                <a class="sidebarElements-links">
                    <i class="fa fa-plane"></i>
                    <span>
                        Time Off & Leave
                        <i class="fa-solid fa-caret-right"></i>
                    </span>
                </a>
                <ul class="dropdown">
                    <li>
                        <a href="request.php">
                            <i class="fa-solid fa-suitcase"></i> 
                            Request
                        </a>
                    </li>
                    <li>
                        <a href="approverequest.php"> 
                            <i class="fa fa-calendar-check-o"></i> 
                            Approve
                        </a>
                    </li>
                    <li>
                        <a href="requesthistory.php">
                            <i class="fa fa-list"></i> 
                            History
                        </a>
                    </li>
                </ul>
            </li>
        <?php } else { ?>
            <li onclick="toggleDropdown(this)">
                <a class="sidebarElements-links">
                    <i class="fa fa-plane"></i>
                    <span>
                        Time Off & Leave
                        <i class="fa-solid fa-caret-right"></i>
                    </span>
                    
                </a>

                <ul class="dropdown">
                    <li>
                        <a href="planer.php">
                            <i class="fa-regular fa-calendar-days"></i> 
                            Planer
                        </a>
                    </li>
                    <li>
                        <a href="approverequest.php"> 
                            <i class="fa fa-plane"></i> 
                            Requests
                        </a>
                    </li>
                    <li>
                        <a href="availability.php">
                            <i class="fa-solid fa-rectangle-list"></i>
                            Availability
                        </a>
                    </li>
                    <li class="menu-item nested" onclick="toggleDropdown(this, event)">
                        <a>
                            <i class="fa-solid fa-pencil"></i>
                            Bulk Update
                            <i class="fa-solid fa-caret-right"></i>
                            
                        </a>

                        <ul class="dropdown">
                            <li>
                                <a href="balances.php">
                                    <i class="fa-solid fa-calculator"></i> 
                                    Balances
                                </a>
                            </li>
                            <li>
                                <a href="allowance.php">
                                    <i class="fa-solid fa-hourglass-half"></i>
                                    Allowances
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="configureLeaves.php">
                            <i class="fa-solid fa-gear"></i> 
                            Configure
                        </a>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <?php if ($_SESSION['role'] == 0) { ?>
                <li Style="cursor: pointer;" class="<?= basename($_SERVER['PHP_SELF']) == 'empexpenses.php' ? 'active' : '' ?>">
                    <a href="empexpenses.php" class="sidebarElements-links">
                        <i class="fa-solid fa-money-bill-1-wave"></i>
                        <span>Expenses</span>
                    </a>
                </li>
            <?php } else { ?>
                <li Style="cursor: pointer;" onclick="toggleDropdown(this)">
                    <a class="sidebarElements-links">
                        <i class="fa-solid fa-money-bill-1-wave"></i>
                        <span>
                            Expenses
                            <i class="fa-solid fa-caret-right"></i>
                        </span>
                        
                    </a>

                    <ul class="dropdown">
                        <li>
                            <a href="expenses.php">
                                <i class="fa-regular fa-square-check"></i> 
                                Expenses
                            </a>
                        </li>
                        <li>
                            <a href="configureExpenses.php"> 
                                <i class="fa-solid fa-gear"></i> 
                                Configure
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            <?php if ($_SESSION['role'] == 0) { ?>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'goals.php' ? 'active' : '' ?>">
                    <a href="goals.php" class="sidebarElements-links">
                        <i class="fa-solid fa-bullseye"></i>
                        <span>Goals</span>
                    </a>
                </li>
            <?php } else { ?>
                <li Style="cursor: pointer;" onclick="toggleDropdown(this)">
                    <a class="sidebarElements-links">
                        <i class="fa-solid fa-bullseye"></i> 
                        <span>
                            Goals
                            <i class="fa-solid fa-caret-right"></i>
                        </span> 
                        
                    </a>
                    <ul id="goalsConfigure" class="dropdown">
                        <li>
                            <a href="assignesGoals.php">
                                <i class="fa-regular fa-square-check"></i>
                                Assigned
                            </a>
                        </li>
                        <li class="menu-item nested" onclick="toggleDropdown(this, event)">
                            <a>
                                <i class="fa-solid fa-gear"></i> 
                                Configure
                                <i class="fa-solid fa-caret-right"></i> 
                                
                            </a>
                            <ul class="dropdown">
                                <li>
                                    <a href="template.php"> 
                                        <i class="fa-regular fa-file-code"></i> 
                                        Templates
                                    </a>
                                </li>
                                <li>
                                    <a href="goalItem.php">
                                        <i class="fa-solid fa-list"></i> 
                                        Goal Items
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            <li class="<?= basename($_SERVER['PHP_SELF']) == 'library.php' ? 'active' : '' ?>">
                <a href="library.php" class="sidebarElements-links"> 
                    <i class="fa-solid fa-book"></i>
                    <span>Library</span>
                </a>
            </li>
            <?php if ($_SESSION['role'] == 0) { ?>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'empNews.php' ? 'active' : '' ?>">
                    <a href="empNews.php" class="sidebarElements-links">
                        <i class="fa-solid fa-newspaper"></i>
                        <span>News</span>
                    </a>
                </li>
            <?php } else { ?>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'news.php' ? 'active' : '' ?>">
                    <a href="news.php" class="sidebarElements-links">
                        <i class="fa-solid fa-newspaper"></i>
                        <span>News</span>
                    </a>
                </li>
        <?php } ?>
        <?php if ($_SESSION['role'] == 0) { ?>
            <li class="<?= basename($_SERVER['PHP_SELF']) == 'pinboard.php' ? 'active' : '' ?>">
                <a href="pinboard.php" class="sidebarElements-links">
                    <i class="fa-solid fa-thumbtack"></i>
                    <span>Pinboard</span>
                </a>
            </li>
        <?php } ?>
        <?php if ($_SESSION['role'] == 1) { ?>
            <li Style="cursor: pointer;" onclick="toggleDropdown(this)">
                    <a class="sidebarElements-links">
                        <i class="fa-solid fa-wrench"></i>
                        <span>
                            Setup
                            <i class="fa-solid fa-caret-right"></i>
                        </span> 
                        
                    </a>
                    <ul id="goalsConfigure" class="dropdown">
                        <li>
                            <a href="CompanyInfo.php">
                                <i class="fa-solid fa-landmark"></i>
                                Company Info
                            </a>
                        </li>
                        <li>
                            <a href="authorisedUsers.php">
                                <i class="fa-solid fa-key"></i>
                                Users
                            </a>
                        </li>
                        <li class="menu-item nested" onclick="toggleDropdown(this, event)">
                            <a>
                                <i class="fa-solid fa-gear"></i> 
                                Configure
                                <i class="fa-solid fa-caret-right"></i> 
                            </a>
                            <ul class="dropdown">
                                <li>
                                    <a href="categories.php"> 
                                        <i class="fa-solid fa-list"></i> 
                                        Categories
                                    </a>
                                </li>
                                <li>
                                    <a href="list.php">
                                        <i class="fa-solid fa-list"></i> 
                                         List
                                    </a>
                                    <a href="goalItem.php">
                                        <i class="fa-solid fa-table-list"></i>
                                         Costum Fields
                                    </a>
                                </li>
                            </ul>
                            <a href="goalItem.php">
                                <i class="fa-solid fa-server"></i>
                                Tools
                            </a>
                        </li>
                    </ul>
                </li>
        <?php } ?>
    </ul>
</div>