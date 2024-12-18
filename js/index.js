function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
function myFunctionTwo() {
  document.getElementById("leaveConfigure").classList.toggle("showTwo");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.Leavebtn')) {
    var dropdowns = document.getElementsByClassName("leave-dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('showTwo')) {
        openDropdown.classList.remove('showTwo');
      }
    }
  }
}
function myFunctionThree() {
  document.getElementById("expensesConfigure").classList.toggle("showThree");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.excbtn')) {
    var dropdowns = document.getElementsByClassName("leave-dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('showThree')) {
        openDropdown.classList.remove('showThree');
      }
    }
  }
}
function myFunctionFour() {
  document.getElementById("goalsConfigure").classList.toggle("showFour");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.goalbtn')) {
    var dropdowns = document.getElementsByClassName("goals-dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('showFour')) {
        openDropdown.classList.remove('showFour');
      }
    }
  }
}


