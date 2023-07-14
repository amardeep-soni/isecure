<?php

include_once "connectdb.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
if (isset($_POST['rememberMe'])) {
    $rememberMe = true;
} else {
    $rememberMe = false;
}

if (!empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // if email is valid
        $sql =  mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) != 0) {
            while ($row = mysqli_fetch_assoc($sql)) {
                if (password_verify("$password", $row['password'])) {
                    $uniqueId = rand(1, 99999);
                    while ($row['session_id'] == $uniqueId) {
                        $uniqueId = rand(1, 99999);
                    }
                    $sql2 = mysqli_query($conn, "UPDATE `users` SET `session_id` = '{$uniqueId}' where `email` = '{$email}'");
                    if ($sql2) {
                        session_start();
                        $_SESSION['iSecureSession'] = $uniqueId;
                        echo $rememberMe ? $uniqueId : "success";
                    }
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
