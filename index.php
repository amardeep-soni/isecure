<?php
session_start();

if (!isset($_SESSION['name'])) {
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
                <h2>Welcome <?php echo $_SESSION['name']; ?></h2>
            </div>
        </div>
    </div>
    <script>
        function logout() {
            location.href = './components/logout.php';
        }
    </script>
</body>

</html>