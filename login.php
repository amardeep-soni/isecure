<?php
session_start();

if (isset($_SESSION['name'])) {
    header("location: ././");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amardeep Isecure App</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="container">
        <div id="loginSignupCont">
            <div id="top">
                <div id="loginText">Login</div>
                <div id="registerText">Register</div>
                <span id="active"></span>
            </div>
            <div id="formCont">
            </div>
        </div>
    </div>
    </div>


    <script src="script.js"></script>
</body>

</html>