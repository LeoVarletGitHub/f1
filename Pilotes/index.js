"use strict";

window.onload = init;

function init() {
    $.ajax({
        url: "ajax/getlesPilotes.php",
        type: 'POST',
        dataType: "json",
        success: afficher,
        error: reponse => console.error (reponse.responseText)
    });

}
function afficher(data) {
    for(const pilote of data) {
        let tr = document.createElement('tr');

        let td =  document.createElement('td');
        td.classList.add('masquer');
        td.innerText = pilote.id;
        tr.appendChild(td);

        td =  document.createElement('td');
        td.innerText = pilote.nom;
        tr.appendChild(td);

        td =  document.createElement('td');
        td.innerText = pilote.nomEcurie;
        tr.appendChild(td);



    lesLignes.appendChild(tr);
}
}

