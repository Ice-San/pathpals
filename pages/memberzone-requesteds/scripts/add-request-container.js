const submitRequest = document.querySelector(".submit-btn-container");
const whereToCreateRequest = document.querySelector(".list");

submitRequest.addEventListener("click", () => {
    let requestContainer = document.createElement("div");

    requestContainer.classList.add("request-container");

    whereToCreateRequest.appendChild(requestContainer);

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