document.addEventListener("DOMContentLoaded", function() {
  var btn = document.getElementById("btn");
  btn.addEventListener("click", function() {
      var colorfulDiv = document.querySelector(".colorful");
      if (colorfulDiv.style.filter === "grayscale(100%)") {
          colorfulDiv.style.filter = "none";
      } else {
          colorfulDiv.style.filter = "grayscale(100%)";
      }
  });
});
