const heroTitle = document.querySelector(".title h1");

window.addEventListener("scroll", () => {
    let y = scrollY;

    heroTitle.style.marginTop = y + "px";
});