const addRequestBtn = document.querySelector(".add-request");
const addRequestList = document.querySelector(".form-list");
const addRequestListContainer = document.querySelector(".form-list-container");

addRequestBtn.addEventListener("click", () => {
    addRequestList.classList.remove("unvisibility");
    addRequestList.classList.remove("form-list-exit-animation");
    addRequestList.classList.add("form-list-enter-animation");

    setTimeout(() => {
        addRequestListContainer.classList.remove("unvisibility");
        addRequestListContainer.classList.remove("form-list-container-animation-exit");
        addRequestListContainer.classList.add("form-list-container-animation");
      }, 501);
});