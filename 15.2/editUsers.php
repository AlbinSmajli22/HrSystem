<?php 
	require 'config.php';

	if (empty($_SESSION['username'])) {
		header('Location: login.php');
	}

	$id = $_GET['id'];
	$sql = "SELECT * from users WHERE id=:id LIMIT 1";

	$prep = $con->prepare($sql);
	$prep->bindParam(':id', $id);
	$prep->execute();
	$datas = $prep->fetch();
?>

<?php require 'header.php'; ?>

<nav class="navbar navbar-dar fixed-top bg-dark flex-md-nowrap p-0 shadow">
	<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"><?= $_SESSION['username'] ?></a>
	
	<ul class="navbar-nav px-3">
		<li class="nav-item text-nowrap">
			<a class="nav-link" href="logout.php">Sign out</a>
		</li>
	</ul>
</nav>

<div class="container-fluid">
	<div class="row">
		<nav class="col-md-2 d-none d-md-block bg-light sidebar" style="min-height:100vh">
			<div class="sidebar-sticky">
				<ul class="nav flex-column">
					<li class="nav-item">
						<a class="nav-link active" href="dashboard.php"><span data-feather="home"></span>Dashboard<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="users.php"><span data-feather="users"></span>Users</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"><span data-feather="file"></span>Projects</a>
					</li>					
				</ul>
			</div>
		</nav>

		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-it-center pd-2 mb-3 border-bottom">
				<h1 class="h2">Edit Users</h1>
			</div>

			<form class="form-signin" method="POST" action="updateLogic.php">

				<input type="hidden" id="id" name="id" value="<?= $datas['ID']; ?>">
				
				<input type="text" name="username" id="username" value="<?= $datas['username'];?>" placeholder="Username" required autofocus class="forom-control">
				
				<input type="text" name="fullname" id="fullname" value="<?= $datas['fullname'];?>" placeholder="Full Name" required class="forom-control">
				
				<input type="email" name="email" id="email" value="<?= $datas['email'];?>" placeholder="Email Adress" required class="forom-control">
				
				<input type="password" name="password" id="inputPassword" value="<?= $datas['password'];?>" placeholder="Password" required class="forom-control">
				
				<button class="btn btn-lg btn-success btn-block" name="update" type="submit">Update</button>
			</form>

			</div>
		</main>
	</div>
</div>

<?php require 'footer.php' ?>

