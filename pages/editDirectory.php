<?php 
	require '../config.php';

	/*if (empty($_SESSION['username'])) {
		header('Location: login.php');
	}*/

	$id = $_GET['id'];
	$sql = "SELECT * from users WHERE id=:id LIMIT 1";

	$prep = $con->prepare($sql);
	$prep->bindParam(':id', $id);
	$prep->execute();
	$datas = $prep->fetch();
?>


<body class="bg-secondary">
	



		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-it-center pd-2 mb-3 border-bottom">
				<h1 class="h2">Edit Employe</h1>
			</div>

			<form class="form-signin" method="POST" action="editDirectoryLogic.php">

				<input type="hidden" id="id" name="id" value="<?= $datas['id']; ?>">
				<input type="text" name="name" id="name" value="<?= $datas['name'];?>" >
                <input type="text" name="surname" id="surname" value="<?= $datas['surname'];?>">
                <input type="email" name="adresa" id="adresa" value="<?= $datas['email'];?>">
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



