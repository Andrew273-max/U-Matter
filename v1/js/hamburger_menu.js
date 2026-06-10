function myFunction() {
    var x = document.getElementById("myLinks");

    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}

document.addEventListener("DOMContentLoaded", () => {

    let authLink = document.getElementById("authLink");

    let isLoggedIn = localStorage.getItem("loggedIn");

    if (isLoggedIn == "true") {

        authLink.textContent = "Profile";
        authLink.href = "profile.php";

    } else {

        authLink.textContent = "Log in";
        authLink.href = "login.php";
    }

});