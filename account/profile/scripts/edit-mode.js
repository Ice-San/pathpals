const editBtn = document.querySelector(".edit");
const editBtnImage = document.querySelector(".edit-image");
const editText = document.querySelector(".edit-mode");

const editUserText = document.querySelector(".username-position p");
const editUserInput = document.querySelector(".username-position input");

const editUserNameText = document.querySelector(".name-background p");
const editUserNameInput = document.querySelector(".name-background input");

const editInfoText = document.querySelectorAll(".info-description p");
const editInfoInput = document.querySelectorAll(".info-description input");
const editSaveBtn = document.getElementById("save-btn");

const errorUsername = document.getElementById("edit-username-error");
const errorPassword = document.getElementById("edit-password-error");
const errorConfirmPassword = document.getElementById("edit-confirm-password-error");

const editInfoLock = document.querySelectorAll(".info-description-exception");

editBtn.addEventListener("click", () => {
    editBtnImage.classList.toggle("edit-container");
    editBtnImage.classList.toggle("edit-close-container");

    editText.classList.toggle("edit-opacity");

    editUserText.classList.toggle("unvisibility");

    editUserInput.classList.toggle("unvisibility");

    editUserNameText.classList.toggle("unvisibility");

    editUserNameInput.classList.toggle("unvisibility");

    for(i = 0; i < editInfoText.length; i++) {
        editInfoText[i].classList.toggle("unvisibility");
    }

    for(i = 0; i < editInfoInput.length; i++) {
        editInfoInput[i].classList.toggle("unvisibility");
    }

    for(i = 0; i < editInfoLock.length; i++) {
        editInfoLock[i].classList.toggle("info-description-input-lock");
    }

    editSaveBtn.classList.toggle("unvisibility");

    if (!errorUsername.classList.contains("unvisibility")) {
        errorUsername.classList.add("unvisibility");
    }

    if (!errorPassword.classList.contains("unvisibility")) {
        errorPassword.classList.add("unvisibility");
    }

    if (!errorConfirmPassword.classList.contains("unvisibility")) {
        errorConfirmPassword.classList.add("unvisibility");
    }
});