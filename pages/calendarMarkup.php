<div class="calendarBody">
    <div class="currentDate" data-month="<?= $calendarMonth ?>" data-year="<?= $calendarYear ?>">
        <h5><?= htmlspecialchars($calendar->getCalendarMonth() . ' ' . $calendarDate->getYear(), ENT_QUOTES, 'UTF-8') ?></h5>
        <div class="calendarControls">
            <button type="button" class="calendar-today" aria-label="Show current month">today</button>
            <button type="button" class="bck" aria-label="Previous month">&lt;</button>
            <button type="button" class="forward" aria-label="Next month">&gt;</button>
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
                                                <?php if (!empty($calendarShowsNames)): ?>
                                                    <strong><?= htmlspecialchars($event['name'], ENT_QUOTES, 'UTF-8') ?></strong>
                                                <?php else: ?>
                                                    <?= htmlspecialchars($event['leaveType'], ENT_QUOTES, 'UTF-8') ?>
                                                <?php endif; ?>
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
                    <div class="legend" style="background-color: <?= htmlspecialchars($leaveType['color'], ENT_QUOTES, 'UTF-8') ?>"></div>
                    <p><?= htmlspecialchars($leaveType['name'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
