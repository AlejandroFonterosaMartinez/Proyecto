var slideIndex = 0;
showSlides();
function showSlides() {
    var i;
    var slides = document.getElementsByClassName("slide");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    slides[slideIndex - 1].style.display = "block";
    setTimeout(showSlides, 2000); // Change image every 2 seconds
}

function showMenu() {
    var x = document.getElementsByClassName("nav-links");
    if (x[0].style.display === "block") {
        x[0].style.display = "none";
    } else {
        x[0].style.display = "block";
    }
}

function getcuentaInfo() {
    // Use AJAX to send a request to a PHP file
    // In the PHP file, retrieve the account information from the database
    // and return it as a JSON object
    $.ajax({
        url: 'getAccountInfo.php',
        type: 'GET',
        success: function (data) { // Parse the returned JSON object
            var account = JSON.parse(data);
            // Display the account information in a dropdown menu
            showAccountInfo(account);
        }
    });
}
