let formContElement = document.getElementById('formCont')

let loginTopBtn = document.getElementById('loginText')
let registerTopBtn = document.getElementById('registerText')


let activeBar = document.getElementById('active');
var registerBtn;

loginTopBtn.addEventListener('click', loginFunction)
registerTopBtn.addEventListener('click', registerFunction)

let counter = 0;
login();
function loginFunction() {
    activeBar.style.left = 20 + 'px'
    if (counter != 0) {
        formContElement.style.height = 285 + 'px';
    }
    setTimeout(() => {
        login();
    }, 400);
}
function registerFunction() {
    // console.log('register');

    register();
    activeBar.style.left = 177 + 'px'
    formContElement.style.height = 385 + 'px'
    setTimeout(() => {
        register();
    }, 400);


}
function register() {
    formContElement.innerHTML = `<form action="" id="registerForm" autocomplete="off" method="post">
        <div id="errorTxt"></div>
        <div id="successTxt"></div>
        <div id="registerMailCont" class="inputCont">
            <img src="img/mail.svg">
            <input type="email" name="email" autofocus placeholder="Email">
        </div>
        <div id="registerUserNameCont" class="inputCont">
            <img src="img/user.svg">
            <input type="text" name="name" placeholder="Full Name">
        </div>
        <div id="registerPasswordCont" class="inputCont">
            <img src="img/loveLock.png">
            <input type="password" name="password" placeholder="Password">
        </div>
        <div id="registerConfirmPasswordCont" class="inputCont">
            <img src="img/loveLock.png">
            <input type="password" name="confirmPassword" placeholder="Confirm password">
        </div>
        <input type="submit" id="registerBtn" value="Register" class="button">
    </form>`;

    var errorText = document.getElementById("errorTxt");
    var successTxt = document.getElementById("successTxt");

    var form = document.getElementById("registerForm");
    registerBtn = document.getElementById("registerBtn");
    form.onsubmit = (e) => {
        e.preventDefault();
    }
    registerBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "./components/signup.php", true);
        xhr.onload = () => {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    formContElement.style.height = 400 + 'px'
                    if (data == "success") {
                        setTimeout(() => {
                            errorText.style.display = 'none';
                            successTxt.style.display = 'block';
                            successTxt.textContent = 'Account created Sccessfully';
                        }, 800);
                        setTimeout(() => {
                            successTxt.textContent = 'Please Login';
                        }, 2000);
                        setTimeout(() => {
                            loginFunction();
                        }, 2500);
                    } else {
                        // console.log(data);
                        setTimeout(() => {
                            errorText.style.display = 'block'
                            successTxt.style.display = 'none';
                            errorText.textContent = data;
                        }, 800);
                    }
                }
            }
        }

        let formData = new FormData(form);
        xhr.send(formData);
    }
}
function login() {
    if (counter == 0) {
        formContElement.style.height = 285 + 'px';
        counter++
    }
    formContElement.innerHTML = `<form action="" id="loginForm" autocomplete="off" method="post">
                                    <div id="errorTxt"></div>
                                    <div id="successTxt"></div>
                                    <div id="loginUserNameCont" class="inputCont">
                                        <img src="img/mail.svg">
                                        <input type="text" name="email" autofocus placeholder="Email">
                                    </div>
                                    <div id="loginPasswordCont" class="inputCont">
                                        <img src="img/loveLock.png">
                                        <input type="password" name="password" placeholder="Password">
                                    </div>
                                    <div id="loginRememberMeCont">
                                        <input type="checkbox" id="rememberText" name="rememberMe">
                                        <label for="rememberText" id="rememberLabel">Remember Me</label>
                                    </div>
                                    <input type="submit" value="Login" id="loginBtn" class="button">
                                </form>`;

    var errorText = document.getElementById("errorTxt");
    var successTxt = document.getElementById("successTxt");

    var form = document.getElementById("loginForm");
    registerBtn = document.getElementById("loginBtn");
    form.onsubmit = (e) => {
        e.preventDefault();
    }

    registerBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "./components/login.php", true);
        xhr.onload = () => {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    console.log(data);
                    formContElement.style.height = 300 + 'px';

                    let parsedData = parseInt(data);
                    let isInteger = !isNaN(parsedData) && Number.isInteger(parsedData);
                    if (isInteger || data == 'success') {
                        if (isInteger) {
                            localStorage.setItem("iSecureSession", parsedData);
                        }
                        setTimeout(() => {
                            errorText.style.display = 'none';
                            successTxt.style.display = 'block';
                            successTxt.textContent = 'Login Verified';
                        }, 800);
                        setTimeout(() => {
                            location.href = "./";
                        }, 1500);
                    } else {
                        // console.log(data);
                        setTimeout(() => {
                            errorText.style.display = 'block';
                            successTxt.style.display = 'none';
                            errorText.textContent = data;
                        }, 800);
                    }
                }
            }
        }

        let formData = new FormData(form);
        xhr.send(formData);
    }
}