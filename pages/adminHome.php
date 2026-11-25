<?php
require_once '../config.php';
require 'Calendar.php';
require 'calendarData.php';
require 'adminHomeLogic.php';
session_start();

$companyId = $_SESSION['company'];

$requestedMonth = filter_input(INPUT_GET, 'month', FILTER_VALIDATE_INT);
$requestedYear = filter_input(INPUT_GET, 'year', FILTER_VALIDATE_INT);
$calendarMonth = ($requestedMonth !== false && $requestedMonth !== null && $requestedMonth >= 1 && $requestedMonth <= 12)
    ? $requestedMonth
    : (int) date('n');
$calendarYear = ($requestedYear !== false && $requestedYear !== null && $requestedYear >= 1000 && $requestedYear <= 9999)
    ? $requestedYear
    : (int) date('Y');

$calendarDate = new CalendarDate();
$calendarDate->setDate($calendarYear, $calendarMonth, 1);
$calendar = new Calendar(new CurrentDate(), $calendarDate);
$calendar->setSundayFirst(false);
$calendar->create();
$currentTime = date('h:i A');

$monthStart = $calendarDate->format('Y-m-01');
$monthEnd = $calendarDate->format('Y-m-t');
$calendarData = getCalendarLeaveData($con, $companyId, $monthStart, $monthEnd);
$calendarEvents = $calendarData['events'];
$calendarLeaveTypes = $calendarData['leaveTypes'];

$upcBDay = "SELECT user_id, name, surname, born,
       DATE_ADD(
           born,
           INTERVAL (YEAR(CURDATE()) - YEAR(born)) YEAR
       ) AS next_birthday
FROM users
WHERE company = :company
HAVING next_birthday BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
ORDER BY next_birthday";

$prep = $con->prepare($upcBDay);
$prep->bindParam(':company', $companyId, PDO::PARAM_INT);
$prep->execute();
$empUpcBDays = $prep->fetchAll();

$upcEAnn = "SELECT user_id, name, surname, started,
       DATE_ADD(
           started,
           INTERVAL (YEAR(CURDATE()) - YEAR(started)) YEAR
       ) AS next_anniversaries
FROM users
WHERE company = :company
HAVING next_anniversaries BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
ORDER BY next_anniversaries";

$prep = $con->prepare($upcEAnn);
$prep->bindParam(':company', $companyId, PDO::PARAM_INT);
$prep->execute();
$empUpcAnns = $prep->fetchAll();

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
    <script src="../js/adminHome.js"></script>
    <script src="../js/calendar.js"></script>
    <link rel="stylesheet" href="../css/homeAdmin.css">
    <link rel="stylesheet" href="../css/calendar.css">
</head>

<body>
    <div>
        <?php include '../template/adminSidebar.php' ?>

    </div>
    <div id="main">
        <?php include '../template/navbar.php' ?>
        <div class="name">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
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
                    <img src="../images/request_leave5.png" alt="" width="48px" height="48px">
                    <h3><a href="newrequest.php">Add an Employee</a></h3>
                </div>
                <div class="shortcutsBodyElements">
                    <img src="../images/company_directory.png" alt="" width="48px" height="48px">
                    <h3><a href="directory.php">View All Employee</a></h3>
                </div>
                <div class="shortcutsBodyElements">
                    <img src="../images/employee_profile.png" alt="" width="48px" height="48px">
                    <h3><a href="myprofile.php">Update Leave Balances</a></h3>
                </div>
                <div class="shortcutsBodyElements">
                    <img src="../images/fill_checklist.png" alt="" width="48px" height="48px">
                    <h3><a href="checklist.php">Add an Admin Manager</a></h3>
                </div>



            </div>

        </div>
        <div class="thirdContainer">
            <div class="leftDiv">
                <div class="upcomingBD">
                    <div class="upcomingBDHead">
                        <h5>
                            <i class="fa-solid fa-cake-candles"></i>
                            Upcoming Birthdays
                        </h5>
                    </div>
                    <div class="upcomingBDBody">
                        <div class="upcomingBDContent">
                            <div class="BDlist">
                                <?php if ($empUpcBDays == null) { ?>
                                    <p> There is no upcoming birthdays</p>
                                <?php } else { ?>

                                    <?php foreach ($empUpcBDays as $empUpcBDay): ?>
                                        <div class="userBD">
                                            <i class="fa-solid fa-cake-candles"></i>
                                            <p>
                                                <?= $empUpcBDay['name'] ?>
                                                <?= $empUpcBDay['surname'] ?>
                                            </p>
                                            <strong>
                                                <?= $empUpcBDay['next_birthday'] ?>
                                            </strong>
                                        </div>
                                    <?php endforeach ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="toDoList">
                    <div class="toDoListHead">
                        <h5>
                            <i class="fa-regular fa-square-check"></i>
                            To Do List
                        </h5>
                    </div>
                    <div class="toDoListBody">
                        <div class="toDoListContent">
                            <div class="toDoList-list" id="todoList">


                            </div>
                            <div class="add-todo">
                                <input type="text" name="todo" id="todoInput" placeholder="Enter a to do task...">
                                <div class="todo-dropdown">
                                    <button class="add-todo-btn" id="addTodoBtn">Add</button>
                                    <button class="addTodoDropdownBtn" onclick="diffToDoFunction()">
                                        &#9660;
                                    </button>
                                    <div id="myToDoDropdown" class="todoDropdownContent">
                                        <button class="priority-option" data-priority="high">
                                            <i class="fa-solid fa-check" style="color: #e00b0b;"></i> Add High Priority
                                        </button>

                                        <button class="priority-option" data-priority="normal">
                                            <i class="fa-solid fa-check" style="color: #000000;"></i> Add Normal
                                            Priority
                                        </button>

                                        <button class="priority-option" data-priority="low">
                                            <i class="fa-solid fa-check" style="color: #cccccc;"></i> Add Low Priority
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="upcomingAnn">
                    <div class="upcomingAnnHead">
                        <h5>
                            <i class="fa-regular fa-calendar-check" ></i>
                            Upcoming Work Anniversaries
                        </h5>
                    </div>
                    <div class="upcomingAnnBody">
                        <div class="upcomingAnnContent">
                            <div class="Annlist">
                                <?php if ($empUpcAnns == null) { ?>
                                    <p> There is no employee work anniversaries coming up soon.</p>
                                <?php } else { ?>

                                    <?php foreach ($empUpcAnns as $empUpcAnn): ?>
                                        <div class="userAnn">
                                            <i class="fa-regular fa-calendar-check" ></i>
                                            <p>
                                                <?= $empUpcAnn['name'] ?>
                                                <?= $empUpcAnn['surname'] ?>
                                            </p>
                                            <strong>
                                                <?= $empUpcAnn['next_anniversaries'] ?>
                                            </strong>
                                        </div>
                                    <?php endforeach ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                </div>
                <div class="clocks">
                    <div class="clock1">
                        <div class="clock1-1">
                            <a href="">Main Office</a>
                        </div>
                        <div class="clock1-2">
                            <i class="fa-regular fa-clock  fa-2xl" style="color: #3772d7;"></i>
                            <?php echo '<h2>' . $currentTime . '</h2>' ?>
                        </div>
                    </div>
                    <div class="clock2">
                        <div class="clock2-1">
                            <a href="">Production Office</a>
                        </div>
                        <div class="clock2-2">
                            <i class="fa-regular fa-clock fa-2xl" style="color: #3772d7;"></i>
                            <?php echo '<h2>' . $currentTime . '</h2>' ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="midDiv">
               <div class="Calendar">
                    <div class="calendarHead">
                        <h5>
                            <img src="../images/calendar.png" alt="" height="24px" width="24px">
                            Calendar
                        </h5>
                    </div>
                    <p class="calendar-error" role="alert" hidden></p>
                    <div class="calendarBody">
                        <div class="currentDate" data-month="<?= $calendarMonth ?>" data-year="<?= $calendarYear ?>">
                            <h5><?= htmlspecialchars($calendar->getCalendarMonth() . ' ' . $calendarDate->getYear(), ENT_QUOTES, 'UTF-8') ?></h5>
                            <div class="calendarControls">
                                <button type="button" class="calendar-today">
                                    today
                                </button>
                                <button type="button" class="bck back" aria-label="Previous month">
                                    &lt;
                                </button>
                                <button type="button" class="forward" aria-label="Next month">
                                    &gt;
                                </button>
                            </div>
                        </div>
                        <div class="calendarTableDiv">
                            <table class="calendarTable">
                                <thead>
                                    <tr>
                                        <?php foreach ($calendar->getDayLabels() as $dayLabel): ?>
                                            <th scope="col"><?= htmlspecialchars($dayLabel, ENT_QUOTES, 'UTF-8') ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($calendar->getWeeks() as $week): ?>
                                        <tr>
                                            <?php foreach ($week as $day): ?>
                                                <?php
                                                $dayDate = $day['currentMonth']
                                                    ? sprintf('%04d-%02d-%02d', $calendarYear, $calendarMonth, $day['dayNumber'])
                                                    : null;
                                                $isToday = $day['currentMonth'] && $calendar->isCurrentDate($day['dayNumber']);
                                                ?>
                                                <td class="<?= $day['currentMonth'] ? 'calendar-current-month' : 'calendar-other-month' ?>">
                                                    <span class="calendar-date<?= $isToday ? ' is-today' : '' ?>">
                                                        <?= $day['dayNumber'] ?>
                                                    </span>
                                                    <?php if ($dayDate !== null && !empty($calendarEvents[$dayDate])): ?>
                                                        <div class="calendar-events">
                                                            <?php foreach ($calendarEvents[$dayDate] as $event): ?>
                                                                <div class="leave-event"
                                                                    style="background-color: <?= htmlspecialchars($event['color'], ENT_QUOTES, 'UTF-8') ?>"
                                                                    title="<?= htmlspecialchars($event['leaveType'], ENT_QUOTES, 'UTF-8') ?>">
                                                                    <strong><?= htmlspecialchars($event['name'], ENT_QUOTES, 'UTF-8') ?></strong>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="legendGuide">
                            <p>Legend:</p>
                            <div class="legendColor">
                                <?php if (!$calendarLeaveTypes): ?>
                                    <p>No leave types configured.</p>
                                <?php else: ?>
                                    <?php foreach ($calendarLeaveTypes as $leaveType): ?>
                                        <div class="legend"
                                            style="background-color: <?= htmlspecialchars($leaveType['color'], ENT_QUOTES, 'UTF-8') ?>"></div>
                                        <p><?= htmlspecialchars($leaveType['name'], ENT_QUOTES, 'UTF-8') ?></p>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ReportsTo">
                    <div class="ReportsToHead">
                        <h5>
                            <img src="../images/orgchart.png" alt="" height="24px" width="24px">
                            You Report To
                        </h5>
                    </div>
                    <div class="ReportsToBody">
                        <img src="../images/albin-smajli.png" alt="">

                    </div>
                </div>
                <div class="RecentReviews">
                    <div class="RecentReviewsHead">
                        <h5>
                            <img src="../images/review.png" alt="" height="24px" width="24px">
                            Recent Reviews
                        </h5>
                    </div>
                    <div class="RecentReviewsBody">
                        <p>
                            You have no performance reviews on file at the moment. As you undertake them, the most
                            recent reviews will be shown here.
                        </p>
                    </div>
                </div>
                <div class="RecentTraining">
                    <div class="RecentTrainingHead">
                        <h5>
                            <img src="../images/training.png" alt="" height="24px" width="24px">
                            Recent Training
                        </h5>
                    </div>
                    <div class="RecentTrainingBody">
                        <p>
                            There are no recent courses in your file at the moment. As you complete internal training
                            courses, they will be displayed here.
                        </p>
                    </div>
                </div>
                <div class="RenewableDocuments">
                    <div class="RenewableDocumentsHead">
                        <h5>
                            <img src="../images/renewable.png" alt="" height="24px" width="24px">
                            Renewable Documents
                        </h5>
                    </div>
                    <div class="RenewableDocumentsBody">
                        <p>
                            There are no renewable documents in your file at the moment. These are documents pertaining
                            to your work, such as a certificates or licences that must be renewed periodically.
                        </p>
                    </div>
                </div>
                <div class="SalaryHistory">
                    <div class="SalaryHistoryHead">
                        <h5>
                            <img src="../images/position.png" alt="" height="24px" width="24px">
                            Your Position/Salary History
                        </h5>
                    </div>
                    <div class="SalaryHistoryBody">
                        <p>
                            There is no position history recorded on your file at the moment.
                        </p>
                    </div>
                </div>
                <div class="AssetsInYourCare">
                    <div class="AssetsInYourCareHead">
                        <h5>
                            <img src="../images/asset.png" alt="" height="24px" width="24px">
                            Assets In Your Care
                        </h5>
                    </div>
                    <div class="AssetsInYourCareBody">
                        <p>
                            There are no company assets currently marked as being out on loan to you. If you are loaned
                            a company asset such as a phone, laptop or keycard etc., then they will show in here.
                        </p>
                    </div>
                </div>
                <div class="YourDependents">
                    <div class="YourDependentsHead">
                        <h5>
                            <img src="../images/dependent.png" alt="" height="24px" width="24px">
                            Your Dependents
                        </h5>
                    </div>
                    <div class="YourDependentsBody">
                        <p>
                            There are no dependents recorded on your file at the moment.
                        </p>
                    </div>
                </div>
            </div>
            <div class="rightDiv">


            </div>

        </div>
        <?php include '../template/footer.php'; ?>
    </div>
</body>

</html>