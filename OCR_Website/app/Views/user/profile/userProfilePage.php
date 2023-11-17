<!DOCTYPE html>

<script>
    function development() {
        
            alert("This feature is under development.");
        
    }
</script>
<html>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>User Profile || VOC</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://fonts.cdnfonts.com/css/google-sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <base href="<?= base_url()?>">
    <link rel='stylesheet' type='text/css' media='screen' href='assets/user/css/profilePage.css'>
    <script defer src='assets/user/js/profilePage.js'></script>
  </head>
  <body style="display: flex; align-items: center; justify-content: center; flex-direction: rows;">
    <div class="profileImagePanel">
      <img src="/imgs/profilePicture.jpg">
      <p class="loginMenuTitle" style="font-size: 1.7rem;"><?=$name?></p>
      <p class="loginMenuTAS" style="font-size: 1.1rem;">A user! OMG</p>
    </div>
    <div class="profilePanel">
      <form name="resetForm" class="columnLogin" action="user/reset" method="POST">
        <span class="material-icons spanIcon" style="color: white; font-size: 3rem;">account_circle</span>
        <p class="loginMenuTitle">User Panel</p>
        <p class="loginMenuTAS">
          <small>Edit your user profile here!</small>
        </p>
        <div class="columnInputElement">
          <label class="loginMenuText">Username:</label>
          <input name="profileUsernameInput" type="text" id="profileUsernameInput" value= "<?= $name?>" required>
        </div>
        <div class="columnInputElement">
          <label class="loginMenuText">Email:</label>
          <input name="profileEmailInput" type="text" id="profileEmailInput" value="<?= $email ?>" required>
        </div>
        <div class="columnInputElement" hidden>
          <label class="loginMenuText">Password:</label>
          <input name="profilePwdInput" type="password" id="profilePwdInput" value= "DO NOT TOUCH THIS" readonly>
        </div>
        <p id="profileInputWarn"></p>
        <div class="loginButtonFlex">
          <button id="profileSaveBtn" class="inMenuBtn" type="button" onclick="development()">
            <span class="material-icons spanIcon">save</span> Save </button>
          <button id="backBtn" type="button" class="inMenuBtn" onclick="window.location.href='home';">Go Back</button>
        </div>
        <button id="removeAccountBtn" type="button" class="inMenuBtn" type="submit" onclick="development()">
          <span class="material-icons spanIcon">delete</span> Remove Account </button>
      </form>
    </div>
  </body>
</html>