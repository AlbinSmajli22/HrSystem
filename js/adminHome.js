
function diffToDoFunction() {
  document.getElementById("myToDoDropdown").classList.toggle("todoShow");
}


window.onclick = function(event) {
  if (!event.target.matches('.addTodoDropdownBtn')) {
    var dropdowns = document.getElementsByClassName("todoDropdownContent");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('todoShow')) {
        openDropdown.classList.remove('todoShow');
      }
    }
  }
}

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
            priority: "high"
        })
    })
    .then(res => res.json())
    .then(data => {
        createTaskElement(data);
        input.value = "";
    });
});


// ✅ LOAD ALL
window.addEventListener("DOMContentLoaded", () => {
    fetch("adminHomeLogic.php?action=get")
    .then(res => res.json())
    .then(tasks => tasks.forEach(createTaskElement));
});


// ✅ DELETE
function deleteTask(id, el){
    fetch("adminHomeLogic.php", {
        method: "POST",
        body: new URLSearchParams({
            action: "delete",
            id: id
        })
    }).then(() => el.closest(".task").remove());
}


// ✅ DONE
function toggleDone(id, checkbox){
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
function createTaskElement(task){
    const div = document.createElement("div");
    div.className = "task";

    div.innerHTML = `
        <div class="task-info">
            <input type="checkbox" ${task.done == 1 ? "checked" : ""} onchange="toggleDone(${task.id}, this)">
            <small>${task.task}</small>
            <button class="priority">${task.priority}</button>
        </div>
        <a onclick="deleteTask(${task.id}, this)">
            <i class="fa fa-trash"></i>
        </a>
    `;

    list.prepend(div);
}
