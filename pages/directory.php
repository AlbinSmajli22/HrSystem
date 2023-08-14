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
    <link rel="stylesheet" href="./css/directory.css">
</head>
<div id="main">
    <table id="userTable">
        <thead>
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
                    <td><a style="text-decoration:none; color:black;" href="editEmp.php?id=<?= $data['id']; ?>">EDIT</a> | <a style="text-decoration:none; color:black;" href="deleteEmp.php?id=<?= $data['id']; ?>">DELETE</a></td>
                </tr>
           <?php endforeach; ?>
        </tbody>
    </table>
</div>