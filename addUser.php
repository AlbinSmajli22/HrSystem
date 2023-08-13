
<?php
include_once 'config.php';

?>
<form action="addUserLogic.php" method="POST">


<input type="text" name="name" id="name" placeholder="name"><br>
<input type="text" name="surname" id="surname" placeholder="surname"><br>
<input type="email" name="email" id="email" placeholder="email"><br>
<input type="password" name="password" id="password" placeholder="password"><br>
<input type="number" name="Position_ID" id="Position_ID" placeholder="Position_ID"><br>
<input type="number" name="Departament_ID" id="Departament_ID" placeholder="Departament_ID"><br>
<input type="number" name="role" id="role"><br>
<button type="submit" name="submit">register</button>
</form>