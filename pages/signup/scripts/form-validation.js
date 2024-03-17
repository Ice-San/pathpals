document.addEventListener("DOMContentLoaded", function() {
    //  Error Elements 

    const usernameError = document.querySelector(".error-username");
    const emailError = document.querySelector(".error-email");
    const institutionError = document.querySelector(".error-institution");
    const passwordError = document.querySelector(".error-password");

    //  Form Inputs

    const usernameInput = document.getElementById("username-input");
    const emailInput = document.getElementById("email-input");
    const institutionInput = document.getElementById("institution-input");
    const passwordInput = document.getElementById("password-input");
    const submitBtn = document.querySelector(".submit input");

    // Form Validation

    submitBtn.addEventListener("click", function(e) {
        if(usernameInput.value.trim().length === 0) {
            usernameError.classList.remove("unvisibility");
            usernameError.textContent = "* Escreva um username...";

            e.preventDefault();
        } else {
            usernameError.classList.add("unvisibility");
        }

        if(emailInput.value.trim().length === 0) {
            emailError.classList.remove("unvisibility");
            emailError.textContent = "* Escreva um email...";

            e.preventDefault();

        } else if (!emailInput.value.includes('@')) {
            emailError.classList.remove("unvisibility");
            emailError.textContent = "* O email deve conter '@'...";

            e.preventDefault();

        } else {
            emailError.classList.add("unvisibility");
        }

        if(institutionInput.value.trim().length === 0) {
            institutionError.classList.remove("unvisibility");
            institutionError.textContent = "* Escreva o código da sua instituição de ensino...";

            e.preventDefault();
        } else {
            institutionError.classList.add("unvisibility");
        }

        if(passwordInput.value.trim().length === 0) {
            passwordError.classList.remove("unvisibility");
            passwordError.textContent = "* Escreva uma senha...";

            e.preventDefault();
        } else {
            passwordError.classList.add("unvisibility");
        }
    });
});