<?php
require_once './config.php';
$sql= "SELECT * from users
        LEFT JOIN position ON users.Position_ID = position.id
        LEFT JOIN departament ON users.Departament_ID = departament.id";
$prep=$con->prepare($sql);
$prep->execute();
$datas= $prep->fetchAll();



?>
<head>
<script src="https://kit.fontawesome.com/3d560ffcbd.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/directory.css">
</head>
<div id="main">
   
    <table id="userTable">
        <thead>
      
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Add Employee
</button>

<!-- Modal -->
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
            <input type="text" class="form-control" name="name" id="name">
          </div>
          <div class="mb-3">
            <label for="surname" class="col-form-label">Surname:</label>
            <input type="text" class="form-control" name="surname" id="surname">
          </div>
          <div class="mb-3">
            <label for="email" class="col-form-label">E-mail:</label>
            <input type="email" class="form-control" name="email" id="email" >
          </div>
          <div class="mb-3">
            <label for="password" class="col-form-label">Password:</label>
            <input type="password" class="form-control" name="password" id="password">
          </div>
          <div class="mb-3">
            <label for="Position_ID" class="col-form-label">Position_ID:</label>
            <input type="number" class="form-control" name="Position_ID" id="Position_ID">
          </div>
          <div class="mb-3">
            <label for="Departament_ID" class="col-form-label">Departament_ID:</label>
            <input type="number" class="form-control" name="Departament_ID" id="Departament_ID">
          </div>
          <div class="mb-3">
            <label for="role" class="col-form-label">Role:</label>
            <input type="number" class="form-control" name="role" id="role">
          </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-success" >Add</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
            <tr>
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
                    <td><?= $data['name'] ?> <?= $data['surname']   ?></td>
                    <td><?= $data['email'] ?></td>
                    <td><?= $data['position_name'] ?></td>
                    <td><?= $data['departament_name'] ?></td>
                    <td>Main Office</td>
                    <td><a style="text-decoration:none; color:black;" href="pages/editDirectory.php?id=<?= $data['id']; ?>">EDIT</a> | <a style="text-decoration:none; color:black;" href="pages/deleteDirectory.php?id=<?= $data['id']; ?>">DELETE</a></td>
                </tr>
           <?php endforeach; ?>
        </tbody>
    </table>
</div>