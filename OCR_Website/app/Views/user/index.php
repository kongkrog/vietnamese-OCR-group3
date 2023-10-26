<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Vietnamese Handwriting Converter</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://fonts.cdnfonts.com/css/google-sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <base href="<?= base_url()?>">
    <link rel='stylesheet' type='text/css' media='screen' href='assets/user/css/main.css'>
    <script defer src='assets/user/js/main.js'></script>
  </head>
  <body>
    <div id="overlay"></div>
    <div class="flexMenu">
      <button id="closeBtn" class="inMenuBtn" onclick="hideMainMenu()">✖</button>
      <p class="altText normalText-Subtitle boldText">Welcome, Guest!</p>
      <p class="altText"> Having a nice day! <br>Please click a section below to scroll to that section. </p>
      <button id="mainBtn" class="inMenuBtn">
        <span class="material-icons spanIcon">home</span> Home </button>
      <button id="descBtn" class="inMenuBtn">
        <span class="material-icons spanIcon">description</span> Description </button>
      <button id="useBtn" class="inMenuBtn">
        <span class="material-icons spanIcon">image</span> Import Image </button>
      <button id="questionBtn" class="inMenuBtn">
        <span class="material-icons spanIcon">help</span> QNA </button>
      <button id="aboutBtn" class="inMenuBtn">
        <span class="material-icons spanIcon">contact_page</span> About Us </button>
    </div>
    <div class="loginMenu">
      <form id="loginForm" action="user/login" method="post">
        <p class="altText normalText-Subtitle boldText">Welcome!</p>
        <div class="loginField">
          <label class="altText">Your gmail:</label>
          <input name="email" type="email" class="form-control" id="email"
                                        placeholder="email" required>
        </div>
        <div class="loginField">
          <label class="altText">Your password:</label>
          <input name="password" type="password" class="form-control"
                                        id="password" placeholder="Nhập vào mật khẩu">
          <button type="button" class="visibleButton">
            <span id="visibleIcon" class="material-icons spanIcon">visibility_off</span>
          </button>
        </div>
        <div class="loginButtonFlex">
          <button id="loginBtn" class="inMenuBtn" type="submit">
            <span class="material-icons spanIcon">login</span> Log In </button>
          <button type="button" id="forgotBtn" class="inMenuBtn" onclick="window.location.href='Views/user/reset/resetPwdPage.html';">
            <span class="material-icons spanIcon"></span>Reset Password? </button>
          <button type="button" id="closeLoginBtn" class="inMenuBtn">
            <span class="material-icons spanIcon"></span>Close </button>
        </div>
      </form>
    </div>
    <div id="mainPageContent">
      <section id="mainSection" class="pageSection">
        <div class="sectionImage"></div>
        <div class="mainSide">
          <header class="flexSpaceBetween">
            <div id="mainGroup" class="menuGroup hidden">
              <button id="menuBtn" class="button">☰</button>
              <p class="normalText centerText textToggle hidden">Main Menu</p>
            </div>
            <div id="logGroup" class="menuGroup hidden">
              <div class="normalText">
              <span class="material-icons spanIcon">dark_mode</span>
              </div>
              <label class="switch">
                <input type="checkbox" id="nightMode" name="nightMode" value="no">
                <span class="slider round"></span>
              </label>
              <div class="normalText">
              <span class="material-icons spanIcon">light_mode</span>
            </div>
              <button id="signBtn" class="button" onclick="window.location.href='user/signup'">Sign Up</button>
              <button id="logBtn" class="button">Log In</button>
            </div>
          </header>
          <div class="tagLineWebsite">
            <div class="flexCenter hidden">
              <div>
                <p class="title">OCR for Vietnamese language!</p>
                <p class="normalText centerText tallText">By using a fine-tuned CNN (Convoluted Neural Network) with many samples. <br>We were able to product such an AI model that can predicts text in image. </p>
              </div>
            </div>
            <div class="flexButton hidden">
              <button id="fakeInputImageBtn" class="button">Import Image <span class="material-icons spanIcon">arrow_downward</span>
              </button>
              <button id="altAboutBtn" class="button buttonInvert">Read About Us</button>
            </div>
            <p class="title title-smaller hidden" style="padding-top: 20px;">The project was made with:</p>
            <div class="libList hidden">
              <div id="lib1" class="libListChild">
                <img class="libImage" src="assets/user/web_files/icons/python_icon.png">
              </div>
              <div id="lib2" class="libListChild">
                <img class="libImage" src="assets/user/web_files/icons/pandas_icon.png">
              </div>
              <div id="lib3" class="libListChild">
                <img class="libImage" src="assets/user/web_files/icons/numpy_icon.png" >
              </div>
              <div id="lib4" class="libListChild">
                <img class="libImage" src="assets/user/web_files/icons/flask_icon.png">
              </div>
            </div>
          </div>
      </section>
      <section id="descSection" class="pageSection">
        <div class="descFlex hidden">
          <div>
            <p class="title title-small leftText">A powerful tools for fast vietnamese <br>handwritting text convertion </p>
            <p class="normalText centerText leftText tallText">By using the power of Artificial Intelligence, <br>our tools can translate handwriting images into computer text <br>very easily with just a few clicks! </p>
          </div>
          <img src="assets/user/web_files/icons/ai_icon.png" width="180" height="180">
        </div>
        <div class="descFlex hidden">
          <div class="featureGrid">
            <div id="featureItem1" class="featureGridItem">
              <img src="assets/user/web_files/icons/accuracy_icon.png" width="50" height="50">
              <p class="altText normalText-Small">
                <b>Accuracy</b>
                <br>
                Up to (acc)%!
              </p>
            </div>
            <div id="featureItem2" class="featureGridItem">
              <img src="assets/user/web_files/icons/fast_icon.png" width="58" height="50">
              <p class="altText normalText-Small">
                <b>Result</b>
                <br>
                (speed) per image!
              </p>
            </div>
            <div id="featureItem3" class="featureGridItem">
              <img src="assets/user/web_files/icons/accessibility_icon.png" width="50" height="52">
              <p class="altText normalText-Small">
                <b>Accessibility</b>
                <br>
                Easy with a few clicks!
              </p>
            </div>
            <div id="featureItem4" class="featureGridItem">
              <img src="assets/user/web_files/icons/language_icon.png" width="60" height="50">
              <p class="altText normalText-Small">
                <b>Language</b>
                <br>
                Made for Vietnamese!
              </p>
            </div>
          </div>
          <div>
            <p class="title title-small rightText"> With high accuracy and fast result <br>Our model is a great tool <br> for vietnamese handwriting convertion </p>
            <p class="normalText centerText rightText tallText">Based on 1500 training sample, our model was able <br>to achieve up to (acc) accuracy! </p>
          </div>
        </div>
      </section>
      <section id="useSection" class="pageSection">
        <div class="flexCenterVertical hidden">
          <p class="title">Input image here!</p>
          <p class="title title-small"> Make sure you using the right formatting!</p>
          <p class="normalText centerText hidden" style="padding: 15px 0 15px 0;">Image should be commonly use image file like: jpeg, png, tiff,...</p>
          <div class="flexCenter hidden">
            <button id="realInputBtn" class="button">Import Image Here <br>
              <span class="material-icons spanIcon">image</span>
            </button>
            <textarea class="textOutput" name="Output">Output here...</textarea>
          </div>
          <div class="confidencePanel">
            <span class="confidenceBar">
              <p class="confidenceValue normalText normalText-Subsubtitle boldText">40%</p>
            </span>
            <p class="normalText boldText">Confident Meter</p>
          </div>
        </div>
      </section>
      <section id="qnaSection" class="pageSection">
        <div class="flexCenterVertical" style="display: flex">
          <p class="title hidden">Questions and Answers</p>
          <p class="normalText centerText hidden" style="text-align: center; padding-bottom: 30px;">The answer to some of the common questions should be found here!</p>
          <div class="qnaMenu" style="display: flex">
            <button id="qna1" class="qnaBtn hidden" onclick="toggleQuestion('answer1')">
              <p class="altText">1. Is this service free?</p>
              <span class="material-icons spanIcon">expand_more</span>
            </button>
            <div id="answer1" class="ansDropdown normalText">
              <p>The service is free, yes. We are definitely not broke and not using our out-of-pocket money.</p>
            </div>
            <button id="qna2" class="qnaBtn hidden" onclick="toggleQuestion('answer2')">
              <p class="altText">2. How can I use the serivce?</p>
              <span class="material-icons spanIcon">expand_more</span>
            </button>
            <div id="answer2" class="ansDropdown normalText">
              <p>If you somehow didn't read the instruction (you illterate), there is an Input Button in the Input Section that you can add your image into. Wait for a bit and the text should show up.</p>
            </div>
            <button id="qna3" class="qnaBtn hidden" onclick="toggleQuestion('answer3')">
              <p class="altText">3. Won't AI will kill us all eventually?</p>
              <span class="material-icons spanIcon">expand_more</span>
            </button>
            <div id="answer3" class="ansDropdown normalText">
              <p>So is the heat death of the universe. Goodbye.</p>
            </div>
            <button id="qna4" class="qnaBtn hidden" onclick="toggleQuestion('answer4')">
              <p class="altText">4. Is there a tier-system account or something?</p>
              <span class="material-icons spanIcon">expand_more</span>
            </button>
            <div id="answer4" class="ansDropdown normalText">
              <p>There is no priority in making a tier system. We won't get more money that way.</p>
            </div>
            <button id="qna5" class="qnaBtn hidden" onclick="toggleQuestion('answer5')">
              <p class="altText">5. How can I donate?</p>
              <span class="material-icons spanIcon">expand_more</span>
            </button>
            <div id="answer5" class="ansDropdown normalText">
              <p>You can donate to us. All we need from you is your credit card number, the five numbers on the back and your expire date.</p>
            </div>
          </div>
        </div>
      </section>
      <section id="aboutSection" class="pageSection">
        <div>
          <p class="title hidden">About Us</p>
          <p class="normalText centerText tallerText hidden">Instructor: Nguyen Vo Thanh Khang <br> We are a small group from FPT University, specialized in AI Technology. <br> Our group consist of five members, each one with equal importance. </p>
        </div>
        <div>
          <p class="title title-small hidden">Member</p>
          <div class="memberTable hidden">
            <div id="member1" class="memberTableChild">
              <p class="altText">Duong Thanh Duy <br>
                <small>
                  <b>Leader</b>
                </small>
              </p>
            </div>
            <div id="member2" class="memberTableChild">
              <p class="altText">Nguyen Tan Kiet <br>
                <small>
                  <i>Member</i>
                </small>
              </p>
            </div>
            <div id="member3" class="memberTableChild">
              <p class="altText">Truong Hoang Phi <br>
                <small>
                  <i>Member</i>
                </small>
              </p>
            </div>
            <div id="member4" class="memberTableChild">
              <p class="altText">Hoang Xuan Canh <br>
                <small>
                  <i>Member</i>
                </small>
              </p>
            </div>
            <div id="member5" class="memberTableChild">
              <p class="altText">Tran Le Anh Minh <br>
                <small>
                  <i>Member</i>
                </small>
              </p>
            </div>
          </div>
        </div>
      </section>
      <footer class="pageFooter">
        <p class="altText centerText">
          <small>Copyright © 2023 Group3 - AI17B FPTU Quy Nhon. All Rights Reserved. </small>
        </p>
      </footer>
  </body>
</html>
