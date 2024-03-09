/*
    Mouse XY
*/

const circle = document.querySelector(".circle");

document.addEventListener("mousemove", (event) => {
    let x = event.clientX;
    let y = event.clientY;

    circle.style.left = x + "px";
    circle.style.top = y + "px";
});

/*
    View Password
*/

const hidePassword = document.querySelector(".view-pass");
const passwordImg = document.getElementById("password-view");
const passwordInput = document.getElementById("password-input");

hidePassword.addEventListener("click", () => {
    passwordImg.classList.toggle("view-pass-container");
    passwordImg.classList.toggle("view-pass-hider-container");

    if(passwordImg.classList.contains("view-pass-hider-container")) {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
});