<!DOCTYPE html>
<html>
  <head>
    <base href="<?= base_url()?>">
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Vietnamese Handwriting Converter || Sign Up</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://fonts.cdnfonts.com/css/google-sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='<?= base_url()?>assets/user/css/sidePage.css'>
    <script defer src='<?= base_url()?>assets/user/js/sidePage.js'></script>
  </head>
  <body>
    <div class="loginMenu">
      <form name="signUpForm" action="user/create" onsubmit="return validateSignUpForm($result)" method="POST"> 
        <div class="columnLogin">
          <p class="loginMenuTitle"> Sign Up</p>
          <p class="loginMenuTAS">
            <small>Enter your details in this form below</small>
          </p>
          <div class="columnInputElement">
            <label class="loginMenuText">Your name <small>(Optional):</small>
            </label>
            <input name="name" type="text" id="inputAddress"  placeholder="Insert your name here..." autofocus>
          </div>
          <!-- <div class="columnInputElement">
            <label class="loginMenuText">Your username:</label>
            <input name="usernameInput" type="text" id="usernameInput" placeholder="Insert username here..." required>
          </div> -->
          <div class="columnInputElement">
            <label class="loginMenuText">Your email:</label>
            <input name="email" type="email" id="inputEmai" placeholder="Insert email here..." required>
          </div>
          <div class="columnInputElement">
            <label class="loginMenuText">Your password:</label>
            <input name="password" type="password" id="password" placeholder="Insert password here..." required>
            <button class="visibleButton" onclick="toggleVisible('password', 'visibleIconPwd');" type="button">
              <span id="visibleIconPwd" class="material-icons spanIcon" style="color: white">visibility_off</span>
            </button>
          </div>
          <div class="columnInputElement">
            <label class="loginMenuText">Retype password:</label>
            <input name="password_confirm" type="password" id="password-confirm" placeholder="Retype password here..." required>
            <button class="visibleButton" onclick="toggleVisible('password-confirm', 'visibleIconRePwd');" type="button" siz>
              <span id="visibleIconRePwd" class="material-icons spanIcon" style="color: white">visibility_off</span>
            </button>
          </div>
          <div>
            <p class="loginMenuTAS">
              <small>
                <i>By signing up, you agreed to sell your soul <br> to the machinery </i>
              </small>
            </p>
            <p id="signUpWarn" class="loginMenuTAS"></p>
          </div>
        </div>
        <div class="loginButtonFlex">
          <button id="loginBtn" class="inMenuBtn">
            <span class="material-icons spanIcon" type="submit">login</span> Sign Up </button>
          <button type="button" "forgotBtn" class="inMenuBtn" onclick="window.location.href='User/home';">
            <span class="material-icons spanIcon"></span>Go Back </button>
        </div>
        <p class="loginMenuTAS">
          <small>Already have an account? <br>Go back to "Log In" in the main page </small>
        </p>
      </form>
    </div>
    <div class="imageSlideShow">
      <button id="image1" class="button" onclick="currentSlide(1)"></button>
      <button id="image2" class="button" onclick="currentSlide(2)"></button>
      <button id="image3" class="button" onclick="currentSlide(3)"></button>
      <button id="image4" class="button" onclick="currentSlide(4)"></button>
      <button id="image5" class="button" onclick="currentSlide(5)"></button>
      <div class="mySlides fade">
        <img src="<?= base_url()?>assets/user/web_files/backgrounds/background-1.jpg">
        <h1>The power of AI.</h1>
      </div>
      <div class="mySlides fade">
        <img src="<?= base_url()?>assets/user/web_files/backgrounds/background-2.png">
        <h1>Great accuracy.</h1>
      </div>
      <div class="mySlides fade">
        <img src="<?= base_url()?>assets/user/web_files/backgrounds/background-3.jpg">
        <h1>High speed.</h1>
      </div>
      <div class="mySlides fade">
        <img src="<?= base_url()?>assets/user/web_files/backgrounds/background-4.jpg">
        <h1>Vietnamese Language supported.</h1>
      </div>
      <div class="mySlides fade">
        <img src="<?= base_url()?>assets/user/web_files/backgrounds/background-5.jpg">
        <h1>Easy to do!</h1>
      </div>
    </div>
  </body>
</html>

