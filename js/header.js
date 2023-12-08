// Declare Elements Consts
const header = document.querySelector(".header");

const headerBackground = document.querySelector(".header-container");
const headerBackgroundOpacity = document.querySelector(".header-opacity");

const headerTitle = document.querySelector(".header-title");
const headerInfo = document.querySelector(".header-info");
const headerInfoText = document.getElementById("header-text");
const headerFinalLine = document.querySelector(".header-final-line");

// Scroll Animations
document.addEventListener("scroll", () => {
    var y = window.scrollY;

    // Hero Background
    if(y < 1200) {
        var backgroundScale = 1 + y / 1300;
        backgroundScale = Math.max(1, backgroundScale);
        headerBackground.style.transform = 'scale(' + backgroundScale + ')';
    }

    if(y >= 1420) {
        blurValue = Math.min((y - 1420) / 20, 12);
        headerBackground.style.filter = "blur(" + blurValue + "px)";
    } else {
        headerBackground.style.filter = "blur(0px)";
    }

    // Hero Scroll Animation
    let lastScrollPosition = 0;

    if (y < 1900) {
        const scrollDirection = y < lastScrollPosition ? "down" : "up";

        if (scrollDirection === "down") {
            header.style.transform = "translateY(" + y + "px)";
            header.style.position = "fixed";
        } else {
            header.style.transform = "translateY(0)";
            header.style.position = "fixed";
        }
    } else {
        header.style.transform = "translateY(1900px)";
        header.style.position = "relative";
    }

    lastScrollPosition = y;


    // Title Opacity
    var headerTitleVisibility = 1 - (y / 750);

    if (headerTitleVisibility > 0) {
        headerTitle.style.opacity  = headerTitleVisibility;
    } else {
        headerTitle.style.opacity  = 0;
    }

    // Header Info
    if( y >= 760) {
        headerTitle.classList.add("displayNone");
        headerTitle.classList.remove("displayVisibility");
        
        headerInfo.classList.remove("displayNone");
        headerInfo.classList.add("displayVisibility");

        headerInfo.style.opacity  = -headerTitleVisibility;
    } else {
        headerTitle.classList.remove("displayNone");
        headerTitle.classList.add("displayVisibility");

        headerInfo.classList.add("displayNone");
        headerInfo.classList.remove("displayVisibility");

        headerInfo.style.opacity  = 0;
    }

    if(y >= 1650) {
        var headerInfoVisibility = 1 - (y / 2000);

        headerInfo.style.opacity  = headerInfoVisibility;
    }

    // Header Info Text
    if( y >= 790) {
        var adjustedMargin = Math.max(15, 150 - y / 10);

        headerInfoText.style.paddingTop = adjustedMargin + "px";
    }

    // Header Final Line

    if(y >= 1400) {
        headerFinalLine.style.width = "3px";
        headerFinalLine.style.height = Math.min(y - 1400, 500) + "px";
    }

    // Background Opacity
    if(y >= 1100) {
        var backgroundOpacity = Math.min((y - 1100) / 950, 1);

        var inverseOpacity = Math.max(backgroundOpacity, 0.35);

        headerBackgroundOpacity.style.backgroundColor = "rgba(0, 0, 0, " + inverseOpacity + ")";
    } else {
        headerBackgroundOpacity.style.backgroundColor = "rgba(0, 0, 0, 0.35)";
    }
});