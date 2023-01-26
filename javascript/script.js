function addDropdownMenu() {
  // Obtén el enlace "Mi Cuenta"
  var accountLink = document.querySelector(".menuPers a:first-child");
  // Obtén el menú desplegable
  var accountMenu = document.querySelector(".account-menu");
  // Agrega un evento de clic al enlace "Mi Cuenta"
  accountLink.addEventListener("click", function (event) {
    event.preventDefault(); // evita que el enlace rediriga a otra página
    accountMenu.classList.toggle("visible"); // muestra/oculta el menú desplegable
  });
}
