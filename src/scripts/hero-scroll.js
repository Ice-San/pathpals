const heroTitle = document.querySelector(".content-text h1");

window.addEventListener("scroll", () => {
    let y = scrollY;

    heroTitle.style.marginTop = y + "px";
});