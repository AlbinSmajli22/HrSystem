<style>
.sidebar {
  list-style: none;
  padding: 0;
  width: 220px;
  background-color: #2c3e50;
  color: white;
  font-family: sans-serif;
}

.menu-item {
  cursor: pointer;
  padding: 10px 15px;
  border-bottom: 1px solid #34495e;
  position: relative;
}

.menu-item:hover {
  background-color: #34495e;
}

.dropdown {
  list-style: none;
  padding-left: 20px;
  margin: 5px 0;
  display: none;
  background-color: #34495e;
}

.dropdown li {
  padding: 8px 10px;
}

.dropdown li a {
  color: #ecf0f1;
  text-decoration: none;
  display: block;
}

.dropdown li a:hover {
  text-decoration: underline;
}

/* Optional: indent nested dropdowns more */
.menu-item.nested {
  padding-left: 20px;
}


</style>
<ul class="sidebar">
  <li class="menu-item" onclick="toggleDropdown(this)">
    Employees ▼
    <ul class="dropdown">
      <li><a href="#">Add Employee</a></li>
      <li><a href="#">All Employees</a></li>
    </ul>
  </li>

  <li class="menu-item" onclick="toggleDropdown(this)">
    Reports ▼
    <ul class="dropdown">
      <li><a href="#">Monthly Report</a></li>
      <li><a href="#">Annual Report</a></li>
    </ul>
  </li>

  <li class="menu-item" onclick="toggleDropdown(this)">
    Settings ▼
    <ul class="dropdown">
      <li><a href="#">Profile</a></li>
      <li><a href="#">Security</a></li>
    </ul>
  </li>
</ul>


<ul class="sidebar">
  <li class="menu-item" onclick="toggleDropdown(this)">
    Employees ▼
    <ul class="dropdown">
      <li><a href="#">Add Employee</a></li>
      <li><a href="#">All Employees</a></li>
      <li class="menu-item nested" onclick="toggleDropdown(this, event)">
        Departments ▼
        <ul class="dropdown">
          <li><a href="#">HR</a></li>
          <li><a href="#">Tech</a></li>
        </ul>
      </li>
    </ul>
  </li>

  <li class="menu-item" onclick="toggleDropdown(this)">
    Reports ▼
    <ul class="dropdown">
      <li><a href="#">Monthly Report</a></li>
      <li><a href="#">Annual Report</a></li>
    </ul>
  </li>
</ul>


<script>
 

function toggleDropdown(element, event) {
  if (event) event.stopPropagation(); // Prevent parent dropdown toggle

  var dropdown = element.querySelector('.dropdown');
  if (dropdown.style.display === 'block') {
    dropdown.style.display = 'none';
  } else {
    dropdown.style.display = 'block';
  }
}



</script>