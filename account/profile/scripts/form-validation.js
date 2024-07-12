document.addEventListener("DOMContentLoaded", function() {
    const usernameInput = document.getElementById("edit-username");
    const passwordInput = document.getElementById("edit-password");
    const confirmPasswordInput = document.getElementById("edit-confirm-password");
    const saveButton = document.getElementById("save-btn");

    const errorUsername = document.getElementById("edit-username-error");
    const errorPassword = document.getElementById("edit-password-error");
    const errorConfirmPassword = document.getElementById("edit-confirm-password-error");

    saveButton.addEventListener("click", function(e) {
        errorUsername.classList.add("unvisibility");
        errorPassword.classList.add("unvisibility");
        errorConfirmPassword.classList.add("unvisibility");

        if (usernameInput.value.trim() === '') {
            e.preventDefault();

            errorUsername.classList.remove("unvisibility");
            errorUsername.querySelector(".error-message").textContent = "* O username não pode estar vazio!";
        }

        if (passwordInput.value.trim() === '') {
            e.preventDefault();

            errorPassword.classList.remove("unvisibility");
            errorPassword.querySelector(".error-message").textContent = "* A password não pode estar vazia!";
        }

        if (confirmPasswordInput.value.trim() === '') {
            e.preventDefault();

            errorConfirmPassword.classList.remove("unvisibility");
            errorConfirmPassword.querySelector(".error-message").textContent = "* É necessário preencher este campo igual ao da password!";
        }

        if (passwordInput.value !== confirmPasswordInput.value) {
            e.preventDefault();

            errorPassword.classList.remove("unvisibility");

            errorPassword.querySelector(".error-message").textContent = "* As passwords não coincidem!";
            errorConfirmPassword.classList.remove("unvisibility");
            errorConfirmPassword.querySelector(".error-message").textContent = "* As passwords não coincidem!";
        }
    });
});
