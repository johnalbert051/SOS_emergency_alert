<head>
  <title>SignUp/LogIn Form</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
    "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
}

body {
  width: 100%;
  padding: 1rem;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: linear-gradient(#141e30, #243b55);
}

main {
  display: flex;
  align-items: center;
  flex-direction: column;
  max-width: 35rem;
  border-radius: 10px;
  background: rgba(0, 0, 0, 0.5);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.6);
  padding: 2rem;
  font-size: 1rem;
  margin-block: 1rem;
  height: 35rem;
  overflow: hidden;
  position: relative;
}

.button-box {
  position: relative;
  background-color: #141e30;
  width: auto;
  border-radius: 2.5rem;
  margin-block: 0.5rem 3.5rem;
  z-index: 0;
}

.toggle-btn {
  display: inline-block;
  color: rgb(255, 255, 255);
  font-size: 1.1rem;
  font-weight: bold;
  letter-spacing: 1px;
  background: transparent;
  border: none;
  padding: 0.6rem 1.5rem;
  cursor: pointer;
  border-radius: 2.5rem;
  z-index: 1;
}

.btn-active-back {
  background: linear-gradient(to right, #03e9f4, #00aab3);
  width: 50%;
  border-radius: 2.5rem;
  height: 100%;
  position: absolute;
  left: 0px;
  z-index: -1;
  transition: 0.5s left linear;
}

.form-box {
  width: 100%;
  position: relative;
}

form {
  width: 100%;
  position: absolute;
  transition: left 0.5s linear;
}

.login-form {
  left: 0px;
}

.register-form {
  left: 115%;
}

.input-box {
  display: flex;
  flex-direction: column;
  font-size: 1rem;
  margin-bottom: 2.5rem;
  position: relative;
}

.input-box input {
  width: 100%;
  padding: 0.4rem 0.2rem;
  font-size: inherit;
  color: #fff;
  outline: none;
  border: none;
  background: transparent;
  border-bottom: 1px solid #fff;
  font-family: inherit;
}

.input-box label {
  color: #fff;
  position: absolute;
  top: 30%;
  pointer-events: none;
  transition: 0.5s;
}

.input-box input:focus + label,
.input-box input:valid + label {
  top: -20px;
  color: #03e9f4;
  font-size: 12px;
  background-color: #243b55;
  padding: 2px 5px;
}

.check-box {
  display: flex;
  align-items: center;
}

input[type="checkbox"] {
  appearance: none;
  height: 0.75rem;
  width: 0.75rem;
  background-color: rgb(184, 184, 184);
  display: grid;
  place-items: center;
  cursor: pointer;
}

input[type="checkbox"]::after {
  content: "";
  transform: scale(0);
  transition: 0.2s transform ease-in-out;
  transform-origin: bottom left;
  clip-path: polygon(14% 44%, 0 65%, 50% 100%, 100% 16%, 80% 0%, 43% 62%);
}

input[type="checkbox"]:checked::after {
  content: "";
  background-color: #03e9f4;
  width: 0.7rem;
  height: 0.7rem;
  transform: scale(1);
}

input[type="checkbox"]:checked {
  background-color: rgba(106, 106, 106, 0.5);
  box-shadow: 0 0 10px #1b1b1b;
}

input[type="checkbox"] + label {
  color: rgb(193, 193, 193);
  font-size: 0.9rem;
  padding-left: 0.6rem;
  cursor: pointer;
}

.check-box span {
  color: rgb(193, 193, 193);
  font-size: 0.9rem;
  position: absolute;
  right: 0px;
  cursor: pointer;
}

.submit-button {
  position: relative;
  display: block;
  margin: 0 auto;
  padding: 0.6rem 1.2rem;
  color: #03e9f4;
  font-size: 1rem;
  font-weight: bold;
  text-transform: uppercase;
  overflow: hidden;
  border: none;
  transition: 0.5s;
  margin-top: 2rem;
  letter-spacing: 2px;
  background-color: rgb(45, 45, 45);
}

.submit-button:hover {
  background: #03e9f4;
  color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 25px #03e9f4;
}

.submit-button span {
  position: absolute;
  display: block;
}

.submit-button span:nth-child(1) {
  top: 0;
  left: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(to right, transparent, #03e9f4);
  animation: btn-anim1 1s linear infinite;
}

@keyframes btn-anim1 {
  0% {
    left: -100%;
  }

  50%,
  100% {
    left: 100%;
  }
}

.submit-button span:nth-child(2) {
  top: -100%;
  right: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(to bottom, transparent, #03e9f4);
  animation: btn-anim2 1s linear infinite 0.25s;
}

@keyframes btn-anim2 {
  0% {
    top: -100%;
  }

  50%,
  100% {
    top: 100%;
  }
}

.submit-button span:nth-child(3) {
  bottom: 0;
  height: 2px;
  width: 100%;
  right: -100%;
  background: linear-gradient(to left, transparent, #03e9f4);
  animation: btn-anim3 1s linear infinite 0.5s;
}

@keyframes btn-anim3 {
  0% {
    right: -100%;
  }

  50%,
  100% {
    right: 100%;
  }
}

.submit-button span:nth-child(4) {
  bottom: -100%;
  left: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(to top, transparent, #03e9f4);
  animation: btn-anim4 1s linear infinite 0.75s;
}

@keyframes btn-anim4 {
  0% {
    bottom: -100%;
  }

  50%,
  100% {
    bottom: 100%;
  }
}

.other-options {
  position: absolute;
  bottom: 1rem;
}

.another-option {
  color: #fff;
  text-align: center;
  font-weight: bold;
  background-color: #243b55;
  border-radius: 50%;
  padding: 5px;
  width: 30px;
  margin-inline: auto;
  margin-bottom: -1rem;
}

.social-icons {
  width: 16rem;
  margin-bottom: 1rem;
  display: flex;
  justify-content: space-around;
}

.social-icons svg {
  width: 2rem;
  height: 2rem;
  padding: 5px;
  border-radius: 50%;
  background-color: #243b55;
  margin-top: 10%;
  cursor: pointer;
}

.social-icons svg:hover {
  box-shadow: 0 0 10px #00aab3;
}

.social-icons svg path {
  fill: #03e9f4;
}

@media (min-width: 390px) {
  main {
    width: 35rem;
  }
}
 h1{
    color:#fff !important;
}
</style>
<body>
  <main>
  <!-- <h1>BARANGAY BANGA 2ND<br>PLARIDEL BULACAN</h1> -->
    <div class="button-box">
        
      <div class="btn-active-back"></div>
      <button class="toggle-btn login-btn">&nbsp;&nbsp;Login</button>
      <button class="toggle-btn register-btn">&nbsp;&nbsp;Register</button>
    </div>
    <div class="form-box">
      <form class="login-form">
        <div class="input-box">
          <input type="text" id="username" required />
          <label for="username">Username</label>
        </div>
        <div class="input-box">
          <input type="password" id="password" required />
          <label for="password">Password</label>
        </div>
        <div class="check-box">
          <input type="checkbox" id="login-checkbox" />
          <label for="login-checkbox">Remember me</label>
          <span>Forgot password?</span>
        </div>
        <button class="submit-button">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          Login
        </button>
      </form>
      <form class="register-form">
        <div class="input-box">
          <input type="text" id="username2" required />
          <label for="username2">Username</label>
        </div>
        <div class="input-box">
          <input type="email" id="email" required />
          <label for="email">Email Id</label>
        </div>
        <div class="input-box">
          <input type="password" id="password2" required />
          <label for="password2">Password</label>
        </div>
        <div class="check-box">
          <input type="checkbox" id="register-checkbox" />
          <label for="register-checkbox">Agree to the terms & conditions</label>
        </div>
        <button class="submit-button">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          Register
        </button>
      </form>
    </div>
    <div class="other-options">
      <div class="another-option">or</div>
      <div class="social-icons">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
          <path d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
          <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
          <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
        </svg>
      </div>
    </div>
  </main>
  <script>
    const login = document.querySelector(".login-btn");
const register = document.querySelector(".register-btn");
const loginForm = document.querySelector(".login-form");
const registerForm = document.querySelector(".register-form");
const btnActiveBack = document.querySelector(".btn-active-back");

login.addEventListener("click", () => {
  btnActiveBack.style.left = "0px";
  registerForm.style.left = "115%";
  loginForm.style.left = "0px";
});

register.addEventListener("click", () => {
  btnActiveBack.style.left = "50%";
  registerForm.style.left = "0px";
  loginForm.style.left = "-115%";
});

  </script>
</body>