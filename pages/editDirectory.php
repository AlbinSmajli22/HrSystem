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

			<form class="form-signin" method="POST" action="">

				<input type="hidden" id="id" name="id" value="<?= $datas['id']; ?>">
				<input type="text" name="emri" id="emri" value="<?= $datas['name'];?>" placeholder="Emri" required autofocus class="form-control">
                <input type="text" name="mbiemri" id="mbiemri" value="<?= $datas['surname'];?>" placeholder="Mbiemri" aria-label="Mbiemri" required autofocus class="form-control">
                <input type="text" name="adresa" id="adresa" value="<?= $datas['email'];?>" placeholder="Adresa" aria-label="Adresa" required autofocus class="form-control">
                <input type="text" name="nrtel" id="nrtel" value="<?= $datas['position_name'];?>" placeholder="Nr.Tel" aria-label="Nr.Tel" required autofocus class="form-control">
                <input type="text" name="email" id="email" value="<?= $datas['departament_name'];?>" placeholder="E-mail" aria-label="E-mail" required autofocus class="form-control">
                <input type="password" name="password" id="password" value="<?= $datas['password'];?>" placeholder="Password" aria-label="Password" required autofocus class="form-control">
               
				
				<button class="btn btn-lg btn-success btn-block" name="update" type="submit">Update</button>
			</form>

			</div>
		</main>
	</div>
</div>
</body>



