<?php

$showSuccess = false;
$showError = false;
$loginStatus = false;
$currentPage = "login";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'components/connectdb.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $userCheckSql = "SELECT * FROM ${tableName} where username = '${username}'";
    $userCheckResult = mysqli_query($conn, $userCheckSql);

    if (mysqli_num_rows($userCheckResult) != 0) {
        while ($row = mysqli_fetch_assoc($userCheckResult)) {
            if (password_verify("$password", $row['users_password'])) {
                $showSuccess = true;
                $loginStatus = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("refresh:2;url=/isecure/welcome.php");
            } else {
                $showError = true;
                $showErrorText = "Password Doesnot Match.";
                header("refresh:2;url=#");
            }
        }
    } else {
        $showError = true;
        $showErrorText = "User not Found. Please <strong>Signup</strong>";
        header("refresh:2;url=#");
    }
    mysqli_close($conn);
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Isecure</title>
</head>

<body>
    <!-- narbar -->
    <?php
    include 'components/nav.php';
    ?>

    <!-- alerts when signup is success -->
    <?php
    if ($showSuccess) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Success!</strong> Your are Logged In.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>";
    }
    if ($showError) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Error!</strong> ${showErrorText}
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>";
    }
    ?>
    <!-- signup form -->
    <div class="container mt-5" style="max-width: 50%;">
        <form action="/isecure/login.php" method="POST">
            <div class="form-group">
                <label for="inputUsername">Username</label>
                <input type="text" name="username" class="form-control" id="inputUsername">
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword">
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>