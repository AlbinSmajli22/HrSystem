function diffToDoFunction() {
  document.getElementById("myToDoDropdown").classList.toggle("todoShow");
}

window.onclick = function (event) {
  if (!event.target.matches(".addTodoDropdownBtn")) {
    var dropdowns = document.getElementsByClassName("todoDropdownContent");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("todoShow")) {
        openDropdown.classList.remove("todoShow");
      }
    }
  }
};

window.addEventListener("DOMContentLoaded", () => {
  const list = document.getElementById("todoList");
  const input = document.getElementById("todoInput");
  const addBtn = document.getElementById("addTodoBtn");

  // ✅ ADD
  addBtn.addEventListener("click", () => {
    const task = input.value.trim();
    if (!task) return;

    fetch("adminHomeLogic.php", {
      method: "POST",
      body: new URLSearchParams({
        action: "add",
        task: task,
        priority: "high",
      }),
    })
      .then((res) => res.json())
      .then((data) => {
        createTaskElement(data);
        input.value = "";
      });
  });

  // ✅ LOAD ALL
  console.log("running fetch");

  fetch("adminHomeLogic.php?action=get")
    .then((res) => res.json())
    .then((tasks) => {
      console.log("TASKS:", tasks);
      tasks.forEach(createTaskElement);
    })
    .catch((err) => console.error("ERROR:", err));

  // ✅ DELETE
  window.deleteTask = function (id, el) {
    fetch("adminHomeLogic.php", {
      method: "POST",
      body: new URLSearchParams({
        action: "delete",
        id: id,
      }),
    }).then(() => el.closest(".task").remove());
  };

  // ✅ DONE
  window.toggleDone = function(id, checkbox){
    const taskText = checkbox.closest(".task-info").querySelector(".task-text");

    if (checkbox.checked) {
        taskText.classList.add("done");
    } else {
        taskText.classList.remove("done");
    }

    fetch("adminHomeLogic.php", {
        method: "POST",
        body: new URLSearchParams({
            action: "update",
            id: id,
            done: checkbox.checked ? 1 : 0
        })
    });
}
  // ✅ CREATE UI
  function createTaskElement(task) {
    const div = document.createElement("div");
    div.className = "task";

    div.innerHTML = `
        <div class="task-info">
            <input type="checkbox" ${task.done == 1 ? "checked" : ""} 
                onchange="toggleDone(${task.id}, this)">
                
            <small class="task-text ${task.done == 1 ? "done" : ""}">
                ${task.task}
            </small>

            <button class="priority">${task.priority}</button>
        </div>
        <a onclick="deleteTask(${task.id}, this)">
            <i class="fa fa-trash"></i>
        </a>
    `;

    list.prepend(div);
}
});
