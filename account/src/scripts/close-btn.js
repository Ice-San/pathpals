const closeBtn = document.querySelector(".close-btn-position");
const addList = document.querySelector(".form-list");
const addRequestListContainerClose = document.querySelector(".form-list-container");

closeBtn.addEventListener("click", () => {
    addRequestListContainerClose.classList.remove("form-list-container-animation");
    addRequestListContainerClose.classList.add("form-list-container-animation-exit");

    setTimeout(() => {
        addRequestListContainerClose.classList.add("unvisibility");

        addList.classList.remove("form-list-enter-animation");
        addList.classList.add("form-list-exit-animation");

        setTimeout(() => {
            addList.classList.add("unvisibility");
          }, 501);
      }, 1001);
});