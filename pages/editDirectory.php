<?php 
	require '../config.php';


	$user_id = $_GET['user_id'];
	$sql = "SELECT * from users WHERE user_id=:user_id LIMIT 1";

	$prep = $con->prepare($sql);
	$prep->bindParam(':user_id', $user_id);
	$prep->execute();
	$datas = $prep->fetch();
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

               
				
				<button class="btn btn-lg btn-success btn-block" name="update" type="submit">Update</button>
			</form>

			</div>
		</main>
	</div>
</div>
</body>



