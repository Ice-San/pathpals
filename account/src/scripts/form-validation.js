document.addEventListener("DOMContentLoaded", function() {

    //      Inputs Vars
    const tripFrom = document.getElementById("tripFrom");
    const tripTo = document.getElementById("tripTo");

    //      Errors Messages Vars
    const tripFromError = document.querySelector(".tripFrom");
    const tripToError = document.querySelector(".tripTo");

    //      RidesSubmit Var
    const rideSubmitBtn = document.querySelector(".submit-btn input");

    rideSubmitBtn.addEventListener("click", function(e) {
        if(tripFrom.value.trim().length === 0) {
            tripFromError.classList.remove("unvisibility");
            tripFromError.textContent = "* Escreva uma origem...";

            e.preventDefault();
        } else {
            tripFromError.classList.add("unvisibility");
        }

        if(tripTo.value.trim().length === 0) {
            tripToError.classList.remove("unvisibility");
            tripToError.textContent = "* Escreva um destino...";

            e.preventDefault();
        } else {
            tripToError.classList.add("unvisibility");
        }
    });
});