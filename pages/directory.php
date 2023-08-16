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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/directory.css">
</head>
<div id="main">
   
    <table id="userTable">
        <thead>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add Employee</button>
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