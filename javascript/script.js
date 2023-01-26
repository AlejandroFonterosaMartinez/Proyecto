function addDropdownMenu() {
  var accountLink = document.getElementById("account-link");
  var accountMenu = document.getElementById("account-menu");
  var menuVisible = false;

  accountLink.addEventListener("mouseover", function () {
    accountMenu.style.display = "block";
    menuVisible = true;
  });

  accountMenu.addEventListener("mouseover", function () {
    menuVisible = true;
  });

  accountLink.addEventListener("mouseout", function () {
    if (!menuVisible) {
      accountMenu.style.display = "none";
    }
  });

  accountMenu.addEventListener("mouseout", function () {
    menuVisible = false;
    accountMenu.style.display = "none";
  });

  var menuLinks = accountMenu.getElementsByTagName("a");
  for (var i = 0; i < menuLinks.length; i++) {
    menuLinks[i].addEventListener("mouseover", function () {
      menuVisible = true;
    });
    menuLinks[i].addEventListener("mouseout", function () {
      menuVisible = false;
      accountMenu.style.display = "none";
    });
  }
}
