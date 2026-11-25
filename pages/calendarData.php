<?php
function calendarSafeColor($color)
{
    return is_string($color) && preg_match('/^#[0-9a-fA-F]{6}$/', $color)
        ? $color
        : '#e3f2fd';
}

function getCalendarLeaveData($con, $companyId, $monthStart, $monthEnd, $userId = null)
{
    $leaveTypeQuery = $con->prepare(
        'SELECT time_off, color
         FROM timeofftype
         WHERE company_id = :company
         ORDER BY time_off'
    );
    $leaveTypeQuery->execute([':company' => $companyId]);

    $leaveTypes = [];
    $leaveColors = [];
    foreach ($leaveTypeQuery->fetchAll(PDO::FETCH_ASSOC) as $leaveType) {
        $color = calendarSafeColor($leaveType['color']);
        $leaveTypes[] = [
            'name' => $leaveType['time_off'],
            'color' => $color,
        ];
        $leaveColors[strtolower(trim($leaveType['time_off']))] = $color;
    }

    $userFilter = $userId === null ? '' : ' AND r.User_ID = :user_id';
    $requestQuery = $con->prepare(
        "SELECT r.`from` AS start_date, r.`to` AS end_date, r.leave_type, u.name, u.surname
         FROM timeoffrequests r
         INNER JOIN users u ON u.user_id = r.User_ID
         WHERE u.company = :company
           AND r.status = 'Approved'
           AND r.`from` <= :month_end
           AND r.`to` >= :month_start" . $userFilter . "
         ORDER BY r.`from`, u.name, u.surname"
    );
    $queryParams = [
        ':company' => $companyId,
        ':month_end' => $monthEnd,
        ':month_start' => $monthStart,
    ];
    if ($userId !== null) {
        $queryParams[':user_id'] = $userId;
    }
    $requestQuery->execute($queryParams);

    $calendarEvents = [];
    foreach ($requestQuery->fetchAll(PDO::FETCH_ASSOC) as $request) {
        $startDate = new DateTimeImmutable(max($request['start_date'], $monthStart));
        $endDate = new DateTimeImmutable(min($request['end_date'], $monthEnd));
        $leaveType = $request['leave_type'];
        $event = [
            'name' => $request['name'] . ' ' . $request['surname'],
            'leaveType' => $leaveType,
            'color' => $leaveColors[strtolower(trim($leaveType))] ?? '#e3f2fd',
        ];

        for ($day = $startDate; $day <= $endDate; $day = $day->modify('+1 day')) {
            $calendarEvents[$day->format('Y-m-d')][] = $event;
        }
    }

    return [
        'events' => $calendarEvents,
        'leaveTypes' => $leaveTypes,
    ];
}
