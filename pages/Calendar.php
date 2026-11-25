<?php

trait DateHelpers{

    public function getMonthNumberDays()
    {
        return (int) $this->format('t');
    }
    public function getCurrentDayNumber()
    {
        return (int) $this->format('j');
    }
    public function getMonthNumber()
    {
        return (int) $this->format('n');
    }
    public function getMonthName()
    {
        return $this->format('F');
    }
    public function getYear()
    {
        return (int) $this->format('Y');
    }
}
class CurrentDate extends DateTimeImmutable
{
    use DateHelpers;
    public function __construct()
    {
        parent::__construct();
    }
}

class CalendarDate extends DateTime
{
    use DateHelpers;
    public function __construct()
    {
        parent::__construct();
        $this->modify('first day of this month');
    }

    public function getMonthStartDayOfWeek()
    {
        return (int)$this->format('N');
    }
}

class Calendar
{
    protected $currentDate;
    protected $calendarDate;

    protected $dayLabels = [
        "Sun","Mon", "Tue", "Wed", "Thu", "Fri", "Sat"
    ];
    
    protected $MonthLabels = [
        "January", "February", "March", "April", "May", "June", "July", "August", "September",
        "October", "November", "December"
    ];
    protected $sundayFirst;
    protected $weeks=[];
    public function __construct(CurrentDate $currentDate, CalendarDate $calendarDate)
    {
        $this->currentDate = $currentDate;
        $this->calendarDate = $calendarDate;
        $this->calendarDate->modify('First day of this month');
    }

    public function getDayLabels()
    {
        return $this->dayLabels;
    }
    public function getMonthLabels()
    {
        return $this->MonthLabels;
    }

    public function setSundayFirst($bool)
    {
        $this->sundayFirst = $bool;
        if (!$this->sundayFirst) {
            array_push($this->dayLabels, array_shift($this->dayLabels));
        }
    }
    public function setMonth($monthNumber)
    {
        $this->calendarDate->setDate($this->calendarDate->getYear(), $monthNumber, 1);
        
    }
    public function getCalendarMonth()
    {
        return $this->calendarDate->getMonthName();
        
    }
    protected function getMonthFirstDay()
    {
        $day = $this->calendarDate->getMonthStartDayOfWeek();

        if ($this->sundayFirst) {
            return $day % 7;
        }
        return $day - 1;
    }

    public function isCurrentDate($dayNumber)
    {
        if ($this->calendarDate->getYear() === $this->currentDate->getYear() &&
            $this->calendarDate->getMonthNumber() === $this->currentDate->getMonthNumber() &&
            $this->currentDate->getCurrentDayNumber() === $dayNumber
        ) {
            return true;
        }
        return false;
    }

    public function getWeeks()
    {
        return $this->weeks;
    }

    public function create()
    {
        $days = [];
        $leadingDays = $this->getMonthFirstDay();
        $monthLength = $this->calendarDate->getMonthNumberDays();
        $previousMonth = clone $this->calendarDate;
        $previousMonth->modify('-1 month');

        for ($day = $previousMonth->getMonthNumberDays() - $leadingDays + 1; $day <= $previousMonth->getMonthNumberDays(); $day++) {
            $days[] = ['currentMonth' => false, 'dayNumber' => $day];
        }

        for ($day = 1; $day <= $monthLength; $day++) {
            $days[] = ['currentMonth' => true, 'dayNumber' => $day];
        }

        $trailingDays = (7 - count($days) % 7) % 7;
        for ($day = 1; $day <= $trailingDays; $day++) {
            $days[] = ['currentMonth' => false, 'dayNumber' => $day];
        }

        $this->weeks = array_chunk($days, 7);
    }
}
?>