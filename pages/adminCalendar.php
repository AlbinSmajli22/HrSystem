<?php
require_once '../config.php';
require 'Calendar.php';
require 'calendarData.php';
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

$monthStart = $calendarDate->format('Y-m-01');
$monthEnd = $calendarDate->format('Y-m-t');
$calendarData = getCalendarLeaveData($con, $companyId, $monthStart, $monthEnd);
$calendarEvents = $calendarData['events'];
$calendarLeaveTypes = $calendarData['leaveTypes'];

$currentTime = date('h:i A');

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/calendar.css">
  <link rel="stylesheet" href="../css/adminCalendar.css">
  <script src="../js/calendar.js"></script>
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
    <div class="calendarHead">
      <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
    </div>
    <div class="calendarPageBody">
      <div class="userCalendar">
        <div class="Calendar">
          <p class="calendar-error" role="alert" hidden></p>
          <?php
          $calendarShowsNames = true;
          require 'calendarMarkup.php';
          ?>
        </div>
      </div>
    </div>

    <?php include '../template/footer.php'; ?>
  </div>

</body>

</html>