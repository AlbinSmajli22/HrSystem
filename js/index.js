document.addEventListener('DOMContentLoaded', () => {
  const toggleBtn = document.getElementById('nav-toggle');
  const sidebar = document.getElementById('sidebar');

  if (toggleBtn && sidebar) {
    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('shrink');
    });
  } else {
    console.error('Missing nav-toggle or sidebar element.');
  }
});


function toggleDropdown(element, event) {
  if (event) event.stopPropagation(); // Prevent parent from toggling

  var dropdown = element.querySelector('.dropdown');
  if (dropdown) {
    dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
  }
}

 const links = document.querySelectorAll(".sidebarElements li");

   // Add click event to each <a> inside the <li>
  listItems.forEach(li => {
    const link = li.querySelector("a");
    link.addEventListener("click", function () {
      localStorage.setItem("activeLink", this.getAttribute("href"));
    });
  });

  // On page load, apply active class to the correct <li>
  window.addEventListener("DOMContentLoaded", () => {
    const activeHref = localStorage.getItem("activeLink");
    listItems.forEach(li => {
      const link = li.querySelector("a");
      if (link.getAttribute("href") === activeHref) {
        li.classList.add("active");
      } else {
        li.classList.remove("active");
      }
    });
  });


