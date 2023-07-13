<?php

include_once "connectdb.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // if email is valid
        $sql =  mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) != 0) {
            while ($row = mysqli_fetch_assoc($sql)) {
                if (password_verify("$password", $row['password'])) {
                    session_start();
                    $_SESSION['name'] = $row['name'];
                    echo "success";
                } else {
                    echo "Password Does not Match!";
                }
            }
        } else {
            echo "Email is not Found!";
        }
    } else {
        echo "This is not a valid email";
    }
} else {
    echo "All the input fields are required!";
}
