<?php

$showSuccess = false;
$showError = false;
$userExists = false;
$loginStatus = false;
$currentPage = "signup";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signupBtn'])) {

        include 'components/connectdb.php';
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $conformPassword = $_POST['conformPassword'];
        $userExistsSql = "SELECT * FROM ${tableName} where username = '${username}'";
        $userExistsResult = mysqli_query($conn, $userExistsSql);
        
        if ($password == $conformPassword) {
            $passhash = password_hash("$password", PASSWORD_DEFAULT);
            if (mysqli_num_rows($userExistsResult) == 0) {
                $sql = "INSERT INTO `${tableName}` (`username`, `users_email`, `users_password`) VALUES ('$username', '$email', '$passhash')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $showSuccess = true;
                    header("refresh:2;url=/isecure/login.php"); // redirect the user to login page when user successfully created an account
                }
            } else {
                $showError = true;
                $showErrorText = "User Already Exists";
                header("refresh:2;url=#"); // reload the page and bring the user to the same page
            }
        } else {
            $showError = true;
            $showErrorText = "Password doesnot Match";
            header("refresh:2;url=#");
        }
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
                <strong>Success!</strong> Your Account is created successfully. Now you can <strong>Login</strong>.
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
        <form action="/isecure/signup.php" method="POST">
            <div class="form-group">
                <label for="inputUsername">Username</label>
                <input type="text" name="username" class="form-control" id="inputUsername">
            </div>
            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail">
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword">
            </div>
            <div class="form-group">
                <label for="inputConformPassword">Conform Password</label>
                <input type="password" name="conformPassword" class="form-control" id="inputConformPassword">
            </div>
            <button type="submit" name="signupBtn" class="btn btn-primary">Signup</button>
        </form>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>