document.addEventListener("DOMContentLoaded", function() {
    //  Error Elements 

    const emailError = document.querySelector(".error-email");
    const passwordError = document.querySelector(".error-password");

    //  Form Inputs

    const emailInput = document.getElementById("email-input");
    const passwordInput = document.getElementById("password-input");
    const submitBtn = document.querySelector(".submit input");

    // Form Validation

    submitBtn.addEventListener("click", function(e) {
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

        if(passwordInput.value.trim().length === 0) {
            passwordError.classList.remove("unvisibility");
            passwordError.textContent = "* Escreva uma senha...";

            e.preventDefault();
        } else {
            passwordError.classList.add("unvisibility");
        }
    });
});