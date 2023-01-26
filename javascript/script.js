function addDropdownMenu() {
  let userMenu = document.querySelector(".user-menu");
  userMenu.addEventListener("click", function (event) {
    event.preventDefault();
    userMenu.classList.toggle("active");
  });
}
