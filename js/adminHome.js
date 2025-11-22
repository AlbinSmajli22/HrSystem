
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