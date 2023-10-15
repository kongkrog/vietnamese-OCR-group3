let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
  }
  
  // Thumbnail image controls
  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("button");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
} 

function toggleVisible(idstring, visIcon) {
  let passwordInput = document.getElementById(idstring);
  let visibleIcon = document.getElementById(visIcon);

  if (passwordInput.getAttribute('type') == "password") {
    visibleIcon.innerHTML = "visibility"
      passwordInput.setAttribute("type", "text")
  } else {
    visibleIcon.innerHTML = "visibility_off"
      passwordInput.setAttribute("type", "password")
  }
}

function validateSignUpForm() {
  warnText = document.getElementById("signUpWarn")

  warnText.style.display = "block"
  warnText.innerHTML = "Checking..."
  let username = document.forms["signUpForm"]["usernameInput"].value;
  let email = document.forms["signUpForm"]["emailInput"].value;
  let pwd = document.forms["signUpForm"]["signUpPwdInput"].value;
  let rePwd = document.forms["signUpForm"]["reSignUpPwdInput"].value;

  if ((/\s/.test(username) == true) || username.length > 30) {
    warnText.innerHTML = "Username invalid! (Contains space or too long)"
    return false;
}

  if ((/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) == false) {
    warnText.innerHTML = "Please input a valid email!";
    return false;
}

  if ((/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,30}$/.test(pwd)) == false) {
    warnText.innerHTML = "Password invalid! Password should be between 8 and 30 characters, contains at least one number, one special character, one uppercase and one lowercase"
    return false;
  }

  if ((rePwd == pwd) == false) {
    warnText.innerHTML = "Retype password doesn't match!"
    return false;
  }

  warnText.innerHTML = "Looking fine!"
  return true;
}

function validateResetForm() {
  warnText = document.getElementById("resetWarn")

  warnText.style.display = "block"
  warnText.innerHTML = "Checking..."
  let email = document.forms["resetForm"]["resetEmailInput"].value;
  let pwd = document.forms["resetForm"]["newPwdInput"].value;
  let rePwd = document.forms["resetForm"]["reNewPwdInput"].value;


  if ((/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) == false) {
    warnText.innerHTML = "Please input a valid email!";
    return false;
}

  if ((/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,30}$/.test(pwd)) == false) {
    warnText.innerHTML = "Password invalid! Password should be between 8 and 30 characters, contains at least one number, one special character, one uppercase and one lowercase"
    return false;
  }

  if ((rePwd == pwd) == false) {
    warnText.innerHTML = "Retype password doesn't match!"
    return false;
  }

  warnText.innerHTML = "Looking fine!"
  return true;
}
