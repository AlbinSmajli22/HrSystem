<?php 
	require 'config.php';

	/*if (empty($_SESSION['username'])) {
		header('Location: login.php');
	}*/

	$id = $_GET['id'];
	$sql = "SELECT * from employes WHERE id=:id LIMIT 1";

	$prep = $con->prepare($sql);
	$prep->bindParam(':id', $id);
	$prep->execute();
	$datas = $prep->fetch();
?>

<?php require 'head.php'; ?>

<body class="bg-secondary">
	
<?php include 'navbar.php'?>



		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-it-center pd-2 mb-3 border-bottom">
				<h1 class="h2">Edit Employe</h1>
			</div>

			<form class="form-signin" method="POST" action="updateEmp.php">

				<input type="hidden" id="id" name="id" value="<?= $datas['id']; ?>">
				<input type="text" name="emri" id="emri" value="<?= $datas['emri'];?>" placeholder="Emri" required autofocus class="form-control">
                <input type="text" name="mbiemri" id="mbiemri" value="<?= $datas['mbiemri'];?>" placeholder="Mbiemri" aria-label="Mbiemri" required autofocus class="form-control">
                <input type="text" name="adresa" id="adresa" value="<?= $datas['adresa'];?>" placeholder="Adresa" aria-label="Adresa" required autofocus class="form-control">
                <input type="text" name="nrtel" id="nrtel" value="<?= $datas['nrTel'];?>" placeholder="Nr.Tel" aria-label="Nr.Tel" required autofocus class="form-control">
                <input type="email" name="email" id="email" value="<?= $datas['email'];?>" placeholder="E-mail" aria-label="E-mail" required autofocus class="form-control">
                <input type="password" name="password" id="password" value="<?= $datas['password'];?>" placeholder="Password" aria-label="Password" required autofocus class="form-control">
                <input type="text" name="paga" id="paga" value="<?= $datas['paga'];?>" placeholder="Paga" aria-label="Paga" required autofocus class="form-control">
				
				<button class="btn btn-lg btn-success btn-block" name="update" type="submit">Update</button>
			</form>

			</div>
		</main>
	</div>
</div>
</body>

<?php require 'footer.php' ?>

