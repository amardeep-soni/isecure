<?php
session_start();

if (!isset($_SESSION['iSecureSession'])) {
    header("location: ././login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Isecure</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="container">
        <div id="welcomeCont">
            <div id="top">
                <h2 id="appText">Isecure</h2>
                <button onclick="logout()" id="logoutBtn" class="button">
                    Logout
                </button>
            </div>
            <div id="welcome">
                <?php
                include_once "./components/connectdb.php";
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE session_id = {$_SESSION['iSecureSession']}");
                if (mysqli_num_rows($sql) != 0) {
                    $row = mysqli_fetch_assoc($sql);
                }
                ?>
                <h2>Welcome <?php echo $row['name']; ?></h2>
            </div>
        </div>
    </div>
    <script>
        function logout() {
            localStorage.removeItem("iSecureSession");
            location.href = './components/logout.php';
        }
    </script>
</body>

</html>