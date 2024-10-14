<?php

// Set the initial value of the variable
$variable = 0;

// Get the current month
$currentMonth = date('n');

// Define the monthly increase amount
$monthlyIncrease = 100;

// Define the number of months to increase the variable
$numberOfMonths = 12;

// Loop through each month and increase the variable
for ($i = 1; $i <= $numberOfMonths; $i++) {
    // Increase the variable if the current month is the same as the iteration month
    if ($currentMonth == $i) {
        $variable += $monthlyIncrease;
    }
}

// Output the final value of the variable
echo "After $numberOfMonths months, the variable is now: $variable";

?>