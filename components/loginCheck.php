<?php
include_once "connectdb.php";
$storageItem = mysqli_real_escape_string($conn, $_POST['storageItem']);
if ($storageItem && $storageItem != 'null') {
    $sql =  mysqli_query($conn, "SELECT * FROM users WHERE session_id = $storageItem");
    if (mysqli_num_rows($sql) != 0) {
        $row = mysqli_fetch_assoc($sql);
        session_start();
        $_SESSION['iSecureSession'] = $row['session_id'];
        echo 'success';
    }
} else {
    session_start();
    if (isset($_SESSION['iSecureSession'])) {
        echo 'success';
    }
}
