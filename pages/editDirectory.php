<?php 
	require '../config.php';


	$user_id = $_GET['user_id'];
	$sql= "SELECT * from users
        LEFT JOIN position ON users.Position_ID = position.position_id
        LEFT JOIN departament ON users.Departament_ID = departament.departament_id
        WHERE user_id=:user_id LIMIT 1";
	 		

	$prep = $con->prepare($sql);
	$prep->bindParam(':user_id', $user_id);
	$prep->execute();
	$datas = $prep->fetch();

	$usersql= "SELECT * from users
        LEFT JOIN position ON users.Position_ID = position.position_id
        LEFT JOIN departament ON users.Departament_ID = departament.departament_id";

		$prep = $con->prepare($usersql);
		$prep->execute();
		$userDatas = $prep->fetch();
?>

<body class="bg-secondary">
	



		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-it-center pd-2 mb-3 border-bottom">
				<h1 class="h2">Edit Employe</h1>
			</div>

			<form method="POST" action="editDirectoryLogic.php">

				<input type="hidden" id="user_id" name="user_id" value="<?= $datas['user_id']; ?>">
				<input type="text" name="name" id="name" value="<?= $datas['name'];?>" >
                <input type="text" name="surname" id="surname" value="<?= $datas['surname'];?>">
                <input type="email" name="email" id="email" value="<?= $datas['email'];?>">
                <input type="number" name="Position_ID" id="Position_ID" value="<?= $datas['Position_ID'];?>">
                <input type="number" name="Departament_ID" id="Departament_ID" value="<?= $datas['Departament_ID'];?>">
                <input type="password" name="password" id="password" value="<?= $datas['password'];?>">
                <input type="number" name="role" id="role" value="<?= $datas['role'];?>">
				<select id="location" name="location">
            		<option value="Main Office">Main Office</option>
              		<option value="Production">Production</option>
            	</select>
				<select id="status" name="status">
					<option value="Casual">Casual</option>
              		<option value="Contract">Contract</option>
              		<option value="Full Time">Full Time</option>
              		<option value="Part">Part Time</option>
              		<option value="Unpaid">Unpaid</option>
            	</select>
				<br>
            	<select id="report_to" name="report_to">
              		<option value="<?= $datas['report_to'];?>">Current Leader</option>
              		<?php foreach ($userDatas as $data): ?>
            			<option value="<?= $data['user_id'] ?>"><?= $data['name'] ?></option>
              		<?php endforeach; ?>
            	</select>
				<select id="gender" name="gender" class="form-control">
              		<option value="<?= $datas['gender'];?>"><?= $datas['gender'];?></option>
              		<option value="Male">Male</option>
              		<option value="Fmale">Fmale</option>
            	</select>
				<input type="date" name="born" id="born">
				<input type="date" name="started" id="started">
				<button class="btn btn-lg btn-success btn-block" name="update" type="submit">Update</button>
			</form>

			</div>
		</main>
	</div>
</div>
</body>



