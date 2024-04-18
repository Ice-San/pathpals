document.addEventListener("DOMContentLoaded", function() {

    //      Inputs Vars
    const tripFrom = document.getElementById("tripFrom");
    const tripTo = document.getElementById("tripTo");
    const tripAt = document.getElementById("tripAt");
    const tripTimeTo = document.getElementById("timeToBtn");

    const tripAtCurrentTime = tripAt.value;
    const tripTimeToCurrentTime = tripTimeTo.value;

    //      Errors Messages Vars
    const tripFromError = document.querySelector(".tripFrom");
    const tripToError = document.querySelector(".tripTo");
    const tripAtError = document.querySelector(".tripAt");
    const tripTimeToError = document.querySelector(".tripTimeTo");

    //      RidesSubmit Var
    const rideSubmitBtn = document.querySelector(".submit-btn input");

    rideSubmitBtn.addEventListener("click", function(e) {
        if(tripFrom.value.trim().length === 0) {
            tripFromError.classList.remove("unvisibility");
            tripFromError.textContent = "* Escreva de onde quer partir...";

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