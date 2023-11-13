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
	var width = window.matchMedia("(max-width: 1200px)")
	let sideMenu = document.querySelector(".flexMenu");
	if (sideMenu.classList.contains("showMenu")) {
		sideMenu.classList.remove('showMenu')
		document.getElementById("mainPageContent").style.marginLeft = "0px";
		document.getElementById("mainGroup").style.marginLeft = "0px";
	} else {
		sideMenu.classList.add('showMenu')
		if (width.matches) {
			void(0)
		} else {
			document.getElementById("mainPageContent").style.marginLeft = "250px";
			document.getElementById("mainGroup").style.marginLeft = "250px";
		}
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
	let passwordInput = document.getElementById("passwordInput");

	if (loginMenu.classList.contains("show")) {
		if (passwordInput.getAttribute('type') == "text") {
			passwordInput.setAttribute("type", "password")
		}
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
	let passwordInput = document.getElementById("password");

	if (loginMenu.classList.contains("show")) {
		if (passwordInput.getAttribute('type') == "text") {
			passwordInput.setAttribute("type", "password")
		}
		loginMenu.classList.remove("show");
		overLay.style.display = "none";
	}
}

function toggleVisible() {
	let passwordInput = document.getElementById("password");
	let visibleIcon = document.getElementById("visibleIcon");

	if (passwordInput.getAttribute('type') == "password") {
		visibleIcon.innerHTML = "visibility"
		passwordInput.setAttribute("type", "text")
	} else {
		visibleIcon.innerHTML = "visibility_off"
		passwordInput.setAttribute("type", "password")
	}
}

function toggleQuestion(question) {
    document.getElementById(question).classList.toggle("showQuestion");
}

function scrollToSection(sectionId) {
    const section = document.querySelector(sectionId);
    if (section) {
      section.scrollIntoView({ behavior: 'smooth' });
    }
}

function changeBackgroundColor() {
	let checkbox = document.getElementById('nightMode');
	let root = document.documentElement;
	
	if (checkbox.checked) {
	  root.style.setProperty('--body-background', "radial-gradient(circle, rgb(255, 255, 255) 0%, rgb(226, 226, 226) 100%)")
	  root.style.setProperty('--gradient-background', "linear-gradient(to right, #e91e63 0%, #c21858 50%, #9c2780 100%)")
	  root.style.setProperty('--image-background', "url('backgrounds/light-background.jpg')")
	  root.style.setProperty('--color1', "#c21858")
	  root.style.setProperty('--color2', "black")
	  root.style.setProperty('--color3', "#c21858")
	  root.style.setProperty('--color4', "#ffcfdf")
	  root.style.setProperty('--color5', "white")
	  root.style.setProperty('--color6', "#ffc1d9")
	  root.style.setProperty('--color7', "white")
	  root.style.setProperty('--color8', "white")
	} else {
	  root.style.setProperty('--body-background', "radial-gradient(circle, rgb(44, 27, 67) 0%, rgb(26, 8, 48) 100%)")
	  root.style.setProperty('--gradient-background', "linear-gradient(to right, #e656d0 0%, #e53f71 50%, #9e30c2 100%)")
	  root.style.setProperty('--image-background', "linear-gradient(to bottom, rgb(26, 8, 48, 0) 80%, rgba(26, 8, 48, 1) 100%), url('backgrounds/background.jpeg')")
	  root.style.setProperty('--color1', "#e53f71")
	  root.style.setProperty('--color2', "white")
	  root.style.setProperty('--color3', "#a846c8")
	  root.style.setProperty('--color4', "#742d8c")
	  root.style.setProperty('--color5', "white")
	  root.style.setProperty('--color6', "white")
	  root.style.setProperty('--color7', "white")
	  root.style.setProperty('--color8', "rgb(44, 27, 67)")
	}
  }

var checkbox = document.getElementById('nightMode');
checkbox.addEventListener('change', changeBackgroundColor);

document.querySelector('#menuBtn').addEventListener('click', showMainMenu);
document.querySelector('#closeLoginBtn').addEventListener('click', closeLoginMenu);
document.querySelector('#closeBtn').addEventListener('click', hideMainMenu);
document.querySelector('#logBtn').addEventListener('click', toggleLoginMenu);
document.querySelector('.visibleButton').addEventListener('click', toggleVisible);

const buttonSectionIds = [
    '#mainBtn',
    '#descBtn',
    '#useBtn',
    '#fakeInputImageBtn',
    '#questionBtn',
    '#aboutBtn',
    '#altAboutBtn'
  ];

const buttonSection = [
    '#mainSection',
    '#descSection',
    '#useSection',
    '#useSection',
    '#qnaSection',
    '#aboutSection',
    '#aboutSection'
]

buttonSectionIds.forEach((buttonId) => {
    document.querySelector(buttonId).addEventListener('click', function() {
      const sectionId = `#${buttonId.slice(1, -3)}Section`;
      scrollToSection(sectionId);
    });
  });

for (let i = 0; i < buttonSection.length; i++) {
  const buttonId = buttonSectionIds[i];
  const sectionId = buttonSection[i];

  document.querySelector(buttonId).addEventListener('click', function() {
    scrollToSection(sectionId);
  });
}
