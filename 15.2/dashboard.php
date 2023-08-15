
<?php require 'config.php';

if (empty($_SESSION['username'])) {
	header('Location:Login.php');
}
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
			<h1 class="h2">Dashboard</h1>
			</div>
		</main>
		
	</div>
</div>


<?php require 'footer.php' ?>