<?php 
$contact_id=$_GET['contact_id'];
?>
<form action="">
<input type="password" name="password" class="password">
<input type="password" name="confirmPassword" class="password">
<button type="submit" name="setPassword">Done</button>
</form>


<a href="deleteContact.php?contact_id=<?= $contact['contact_id'] ?>"> </a>