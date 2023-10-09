const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add('show')
        } else {
            entry.target.classList.remove("show")
        }
    });
});

const hiddenElements = document.querySelectorAll(".hidden");
hiddenElements.forEach((el) => observer.observe(el));

function showMainMenu() {
    let sideMenu = document.querySelector(".flexMenu");
    if (sideMenu.classList.contains("showMenu")) {
        sideMenu.classList.remove('showMenu')
        document.getElementById("mainPageContent").style.marginLeft = "0px";
        document.getElementById("mainGroup").style.marginLeft = "0px";
    }
    else {
        sideMenu.classList.add('showMenu')
        document.getElementById("mainPageContent").style.marginLeft = "250px";
        document.getElementById("mainGroup").style.marginLeft = "250px";
    }
}

function hideMainMenu() {
    let sideMenu = document.querySelector(".flexMenu");
    sideMenu.classList.remove('showMenu')
    document.getElementById("mainPageContent").style.marginLeft = "0px";
    document.getElementById("mainGroup").style.marginLeft = "0px";
}

function toggleLoginMenu() {
    let loginMenu = document.querySelector(".loginMenu");
    let overLay = document.getElementById("overlay");
    if (loginMenu.classList.contains("show")) {
        loginMenu.classList.remove("show");
        overLay.style.display = "none"; 
      } else {
        loginMenu.classList.add("show");
        overLay.style.display = "block";
      }
}

function closeLoginMenu() {
    let loginMenu = document.querySelector(".loginMenu");
    let overLay = document.getElementById("overlay");
    if (loginMenu.classList.contains("show")) {
        loginMenu.classList.remove("show");
        overLay.style.display = "none"; 
    }
}