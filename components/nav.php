<?php
$signupActive = "";
$loginActive = "";
$welcomeActive = "";
if ($currentPage == "signup") {
    $signupActive = "active";
} else if ($currentPage == "login") {
    $loginActive = "active";
} else if ($currentPage == "welcome") {
    $welcomeActive = "active";
}
echo "<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
        <a class='navbar-brand' href='#'>Isecure</a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav mr-auto'>";
if ($loginStatus) {
    echo "<li class='nav-item ${welcomeActive}'>
            <a class='nav-link' href='/isecure/welcome.php'>Welcome</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='/isecure/logout.php'>Logout</a>
        </li>";
}
if (!$loginStatus) {
    echo "<li class='nav-item ${signupActive}'>
    <a class='nav-link' href='/isecure/signup.php'>Signup</a>
    </li>
    <li class='nav-item ${loginActive}'>
        <a class='nav-link' href='/isecure/login.php'>Login</a>
    </li>";
}
echo "</ul>
        </div>
    </nav>";
