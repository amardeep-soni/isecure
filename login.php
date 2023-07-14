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
    <script>
        var storageItem = localStorage.getItem('iSecureSession');
        console.log(storageItem);
        window.onload = function() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "./components/loginCheck.php", true);
            xhr.onload = () => {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        console.log(data);
                        if (data == 'success') {
                            location.href = './';
                        }
                    }
                }
            }
            let formData = new FormData();
            formData.append('storageItem', storageItem);
            xhr.send(formData);
        };
    </script>
</body>

</html>