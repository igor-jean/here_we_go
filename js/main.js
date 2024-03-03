const btnAudio = document.getElementById("btn-audio");
const htmlAudio = document.getElementById("text-to-audio");
const texteLong = document.getElementById("texte-long").textContent;

btnAudio.addEventListener("click", () => {
    htmlAudio.style.display = "inline-block";
    btnAudio.style.display = "none";

    // Envoyer une requête AJAX vers le fichier PHP avec le texte-long
    fetch('models/generateAudio.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            texte: texteLong
        })
    })
        .then(response => response.json())
        .then(data => {
            // Traiter la réponse
            if (data.success) {
                const sourceAudio = document.createElement("source");
                sourceAudio.src = data.audio;
                sourceAudio.type = "audio/mpeg";

                const audioElement = document.createElement("audio");
                audioElement.controls = true;
                audioElement.appendChild(sourceAudio);

                htmlAudio.appendChild(audioElement);
            } else {
                console.error(data.error);
            }
        })
        .catch(error => {
            console.error('Erreur lors de la requête:', error);
        });
});
