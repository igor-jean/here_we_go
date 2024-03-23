// Afficher date picker pour la recherche 
const btnParDate = document.getElementById("checkbox_toggle");
const inputSearch = document.getElementById("searchBox");
const datepicker = document.querySelector(".datepicker");

btnParDate.addEventListener("click", () => {
    inputSearch.classList.toggle('none');
    datepicker.classList.toggle('visible')
})

