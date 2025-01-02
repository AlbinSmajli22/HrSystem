<?php
require_once '../config.php';
session_start();

include 'addNewGoal.php';
var_dump($userId );
?>

<form action="" method="post">
<input type="text" name="description" placeholder="description">
<textarea name="comments" id="comments" placeholder="comments"></textarea>
<select name="type" id="type">
    <option value="number">number</option>
    <option value="currency">currency</option>
    <option value="counter">counter</option>
    <option value="percentage">percentage</option>
    <option value="objective">objective</option>
</select>
<input type="date" name="due_date" placeholder="due date">
<input type="number" name="target" id="target" placeholder="target"> 

<button type="submit" name="addGoal">Submit</button>
<button type="submit" name="addGoal"><a href="goals.php">Cancel</a></button>

</form>