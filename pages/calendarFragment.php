<?php
require_once '../config.php';
require 'Calendar.php';
require 'calendarData.php';
session_start();

if (!isset($_SESSION['user_id'], $_SESSION['company'])) {
    http_response_code(401);
    exit('Sign in is required to load the calendar.');
}

$companyId = (int) $_SESSION['company'];
$userId = isset($_SESSION['role']) ? (int) $_SESSION['user_id'] : null;

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

$calendarData = getCalendarLeaveData(
    $con,
    $companyId,
    $calendarDate->format('Y-m-01'),
    $calendarDate->format('Y-m-t'),
    $userId
);
$calendarEvents = $calendarData['events'];
$calendarLeaveTypes = $calendarData['leaveTypes'];

header('Content-Type: text/html; charset=UTF-8');
require 'calendarMarkup.php';
