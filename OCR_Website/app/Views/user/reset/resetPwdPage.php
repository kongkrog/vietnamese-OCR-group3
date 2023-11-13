<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <base href="<?= base_url()?>">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Vietnamese Handwriting Converter || Reset Password</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://fonts.cdnfonts.com/css/google-sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='assets/user/css/sidePage.css'>
    <script defer src='assets/user/js/sidePage.js'></script>
  </head>
  <body>
    <div class="loginMenu">
      <form name="resetForm" class="columnLogin" onsubmit="return validateResetForm()" action="user/validateReset" method="POST">
        <p class="loginMenuTitle"> Reset Password</p>
        <p class="loginMenuTAS">
          <small>Enter to reset your password</small>
        </p>
        <div class="columnInputElement">
          <label class="loginMenuText">Your email:</label>
          <input name="resetEmailInput" type="text" id="resetEmailInput" placeholder="Input email here..." required>
        </div>
        <div class="columnInputElement">
          <label class="loginMenuText">Your old password:</label>
          <input name="oldPwdInput" type="password" id="oldPwdInput" placeholder="Input old password..." required>
          <button type="button" class="visibleButton" onclick="toggleVisible('oldPwdInput', 'oldPwd')">
            <span id="oldPwd" class="material-icons spanIcon" style="color: white">visibility_off</span>
          </button>
        </div>
        <div class="columnInputElement">
          <label class="loginMenuText">Your new password:</label>
          <input name="newPwdInput" type="password" id="newPwdInput" placeholder="Input new password..." required>
          <button type="button" class="visibleButton" onclick="toggleVisible('newPwdInput', 'newPwd')">
            <span id="newPwd" class="material-icons spanIcon" style="color: white">visibility_off</span>
          </button>
        </div>
        <div class="columnInputElement">
          <label class="loginMenuText">Retype new password:</label>
          <input name="reNewPwdInput" type="password" id="reNewPwdInput" placeholder="Retype new password..." required>
          <button type="button" class="visibleButton" onclick="toggleVisible('reNewPwdInput', 'reNewPwd')">
            <span id="reNewPwd" class="material-icons spanIcon" style="color: white">visibility_off</span>
          </button>
        </div>
        <p id="resetWarn"></p>
        <div class="loginButtonFlex">
          <button id="loginBtn" class="inMenuBtn" type="submit">
            <span class="material-icons spanIcon">restart_alt</span> Reset </button>
      </form>
      <button id="backBtn" class="inMenuBtn" onclick="window.location.href='user/home';">Go Back</button>
    </div>
    <p class="loginMenuTAS">
      <small>Not the page you looking for? <br>Go back to the main page by using "Go Back" </small>
    </p>
    </div>
    <div class="imageSlideShow">
      <button id="image1" class="button" onclick="currentSlide(1)"></button>
      <button id="image2" class="button" onclick="currentSlide(2)"></button>
      <button id="image3" class="button" onclick="currentSlide(3)"></button>
      <button id="image4" class="button" onclick="currentSlide(4)"></button>
      <button id="image5" class="button" onclick="currentSlide(5)"></button>
      <div class="mySlides fade">
        <img src="backgrounds/background-1.jpg">
        <h1>The power of AI.</h1>
      </div>
      <div class="mySlides fade">
        <img src="backgrounds/background-2.png">
        <h1>Great accuracy.</h1>
      </div>
      <div class="mySlides fade">
        <img src="backgrounds/background-3.jpg">
        <h1>High speed.</h1>
      </div>
      <div class="mySlides fade">
        <img src="backgrounds/background-4.jpg">
        <h1>Vietnamese Language supported.</h1>
      </div>
      <div class="mySlides fade">
        <img src="backgrounds/background-5.jpg">
        <h1>Easy to do!</h1>
      </div>
    </div>
  </body>
</html>