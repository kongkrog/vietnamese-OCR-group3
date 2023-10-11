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
	} else {
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
	let passwordInput = document.getElementById("passwordInput");

	if (loginMenu.classList.contains("show")) {
		if (passwordInput.getAttribute('type') == "text") {
			passwordInput.setAttribute("type", "password")
		}
		loginMenu.classList.remove("show");
		overLay.style.display = "none";
	}
}

function toggleVisible() {
	let passwordInput = document.getElementById("passwordInput");
	if (passwordInput.getAttribute('type') == "password") {
		passwordInput.setAttribute("type", "text")
	} else {
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
    '#qnaBtn',
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