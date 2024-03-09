// Afficher date picker pour la recherche 
const btnParDate = document.getElementById("boutton-datepicker");
const inputSearch = document.getElementById("searchBox");
const datepicker = document.querySelector(".datepicker");
const btnTextContent = document.querySelector(".boutton-datepicker-textcontent")

btnParDate.addEventListener("click", () => {
    inputSearch.classList.toggle('none');
    datepicker.classList.toggle('visible')
    if (btnTextContent.textContent === "Par Mot-clé") {
        btnTextContent.textContent = "Par Date"
    } else {
        btnTextContent.textContent = "Par Mot-clé"
    }
})

