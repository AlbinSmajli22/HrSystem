<?php
require_once '../config.php';
$action = $_REQUEST['action'] ?? '';



switch($action){

    // ✅ ADD TASK
    case "add":
    $task = $_POST['task'] ?? '';
    $priority = $_POST['priority'] ?? 'normal';

    $stmt = $con->prepare("INSERT INTO tasks (task, priority) VALUES (?, ?)");
    $stmt->execute([$task, $priority]);

    echo json_encode([
        "id" => $con->lastInsertId(), // ✅ FIXED
        "task" => $task,
        "priority" => $priority,
        "done" => 0
    ]);
    break;


    // ✅ GET ALL TASKS
    case "get":
    $stmt = $con->prepare("SELECT * FROM tasks WHERE done=0 ORDER BY id DESC");
    $stmt->execute();

    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($tasks);
    break;


    // ✅ DELETE
    case "delete":
    $id = $_POST['id'] ?? 0;

    $stmt = $con->prepare("DELETE FROM tasks WHERE id=?");
    $stmt->execute([$id]);

    echo json_encode(["success" => true]);
    break;


    // ✅ UPDATE DONE
    case "update":
    $id = $_POST['id'] ?? 0;
    $done = $_POST['done'] ?? 0;

    $stmt = $con->prepare("UPDATE tasks SET done=? WHERE id=?");
    $stmt->execute([$done, $id]);

    echo json_encode(["success" => true]);
    break;
}
?>
