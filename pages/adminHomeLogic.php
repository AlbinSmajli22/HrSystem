<?php

$action = $_REQUEST['action'] ?? '';

switch($action){

    // ✅ ADD TASK
    case "add":
        $task = $_POST['task'];
        $priority = $_POST['priority'];

        $stmt = $conn->prepare("INSERT INTO tasks (task, priority) VALUES (?, ?)");
        $stmt->bind_param("ss", $task, $priority);
        $stmt->execute();

        echo json_encode([
            "id" => $stmt->insert_id,
            "task" => $task,
            "priority" => $priority,
            "done" => 0
        ]);
        break;


    // ✅ GET ALL TASKS
    case "get":
        $result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");

        $tasks = [];
        while($row = $result->fetch_assoc()){
            $tasks[] = $row;
        }

        echo json_encode($tasks);
        break;


    // ✅ DELETE
    case "delete":
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM tasks WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        break;


    // ✅ UPDATE DONE
    case "update":
        $id = $_POST['id'];
        $done = $_POST['done'];

        $stmt = $conn->prepare("UPDATE tasks SET done=? WHERE id=?");
        $stmt->bind_param("ii", $done, $id);
        $stmt->execute();
        break;
}
?>
