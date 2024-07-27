const addRequestBtn = document.querySelector(".add-request");
const addRequestList = document.querySelector(".form-list");
const addRequestListContainer = document.querySelector(".form-list-container");
const contentBehindForm = document.querySelector(".content");

addRequestBtn.addEventListener("click", () => {
    addRequestList.classList.remove("unvisibility");
    addRequestList.classList.remove("form-list-exit-animation");
    addRequestList.classList.add("form-list-enter-animation");

    setTimeout(() => {
        contentBehindForm.classList.add("unvisibility");
        addRequestListContainer.classList.remove("unvisibility");
        addRequestListContainer.classList.remove("form-list-container-animation-exit");
        addRequestListContainer.classList.add("form-list-container-animation");
      }, 501);
});