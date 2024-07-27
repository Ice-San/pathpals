// Declare Vars
let checkAll = document.querySelector(".check-user input[type='checkbox']");
let allCheckInputs = document.querySelectorAll(".table-content-left-extra input[type='checkbox']:not(.unvisibility)");

// Code
checkAll.addEventListener('change', () => {
    for (let i = 0; i < allCheckInputs.length; i++) {
        allCheckInputs[i].checked = checkAll.checked;
    }
});
