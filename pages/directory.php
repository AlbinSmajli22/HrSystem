<?php
require_once './config.php';
$sql= "SELECT * from users
        LEFT JOIN position ON users.Position_ID = position.position_id
        LEFT JOIN departament ON users.Departament_ID = departament.departament_id";


if (isset($_POST['search'])) {

  $searchRequest = $_POST['search-box'];

  $sql= "SELECT * from users
        LEFT JOIN position ON users.Position_ID = position.position_id
        LEFT JOIN departament ON users.Departament_ID = departament.departament_id
        WHERE name LIKE '{$searchRequest}%' ";
}

$prep=$con->prepare($sql);
$prep->execute();
$datas= $prep->fetchAll();

$currentTime = date('h:i A');

?>



<head>
<script src="https://kit.fontawesome.com/3d560ffcbd.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/directory.css">
</head>
<body>
  

<?php if ($_SESSION['role']==1) { ?>
<div id="main">
<div>
  <h3>MetDaan</h3>
</div>
<div id="clocks">
    <div id="clock1">
      <div id="clock1-1">
        
        <a href="">Main Office</a>
      </div>
      <div id="clock1-2">
        <i class="fa-regular fa-clock  fa-2xl" style="color: #3772d7;"></i>
        <?php echo '<h2>'.$currentTime.'</h2>' ?>
      </div>
    </div>
    <div id="clock2">
      <div id="clock2-1">
        
        <a href="">Production Office</a>
      </div>
      <div id="clock2-2">
        <i class="fa-regular fa-clock fa-2xl" style="color: #3772d7;"></i>
        <?php echo '<h2>'.$currentTime.'</h2>' ?>
      </div>  
    </div>
</div>

<div id="usersData">
   <div id="filters">
    <h5>Employee Directory</h5>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
      Add Employee
    </button>
    <button>Filter</button>
   </div>
   <form id="serachBar" method="POST">
    <input type="text" name="search-box" id="search-box">
    <button type="submit" name='search'>Search</button>
</form>
    <table id="userTable">
        <thead>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Employee</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="./addUserLogic.php" method="POST">
          <div class="mb-3">
            <label for="name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" name="name" id="name" required>
          </div>
          <div class="mb-3">
            <label for="surname" class="col-form-label">Surname:</label>
            <input type="text" class="form-control" name="surname" id="surname" required>
          </div>
          <div class="mb-3">
            <label for="email" class="col-form-label">E-mail:</label>
            <input type="email" class="form-control" name="email" id="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="col-form-label">Password:</label>
            <input type="password" class="form-control" name="password" id="password" required>
          </div>
          <div class="mb-3">
            <label for="Position_ID" class="col-form-label">Position_ID:</label>
            <input type="number" class="form-control" name="Position_ID" id="Position_ID" required>
          </div>
          <div class="mb-3">
            <label for="Departament_ID" class="col-form-label">Departament_ID:</label>
            <input type="number" class="form-control" name="Departament_ID" id="Departament_ID" required>
          </div>
          <div class="mb-3">
            <label for="role" class="col-form-label">Role:</label >
            <input type="number" class="form-control" name="role" id="role" required>
          </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-success" >Registre Employee</button>
            </div>
      </form>
      </div>  
    </div>
  </div>
</div>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Position</th>
                <th>Departament</th>
                <th>Location</th>
                <th>Edit / Delete</th>                
            </tr>
        </thead>
        <tbody>
           <?php foreach($datas as $data): ?>
                <tr>
                  <td><?= $data['user_id'] ?></td>
                    <td><?= $data['name'] ?> <?= $data['surname']?></td>
                    <td><?= $data['email'] ?></td>
                    <td><?= $data['position_name'] ?></td>
                    <td><?= $data['departament_name'] ?></td>
                    <td>Main Office</td>
                    <td>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editemployee">
                        <a Style="color:white;" href="pages/editDirectory.php?user_id=<?= $data['user_id']; ?>">Edit </a>
                      </button> | 
                      <button type="button" class="btn btn-danger" >
                         <a Style="color:white;" href="pages/deleteDirectory.php?user_id=<?= $data['user_id']; ?>">Delete </a>
                      </button>
                    </td>

                </tr>
           <?php endforeach; ?>
        </tbody>
    </table>
           </div>
</div>
<?php
} else { ?>

<div id="main">
  <div id="usersData">
<div id="filters">
    <h5>Employee Directory</h5>
    <button>Filter</button>
   </div>
   <div id="serachBar">
    <input type="text" name="search" id="search">
    <button type="submit">Search</button>
   </div>
    <table id="userTable">
        <thead>     
            <tr>
                <th>Name</th>
                <th>Contact</th>
                <th>Position</th>
                <th>Departament</th>
                <th>Location</th>
                            
            </tr>
        </thead>
        <tbody>
           <?php foreach($datas as $data): ?>
                <tr>
                    <td><?= $data['name'] ?> <?= $data['surname']   ?></td>
                    <td><?= $data['email'] ?></td>
                    <td><?= $data['position_name'] ?></td>
                    <td><?= $data['departament_name'] ?></td>
                    <td>Main Office</td>
                </tr>
           <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>

<?php
}
?>
</body>