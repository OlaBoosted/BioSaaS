/**
function production(){
    let début = [];
    
    document.getElementById("start").innerHTML = "La production a commencé !";
    début += new Date();

    function productionStop(){
        let fin = [];
        fin += new Date();

    }

    //configure l'apparition d'un nouveau bouton et les actions qui s'en suivent
    document.addEventListener(DOMContentLoaded, function(){

        //créer l'élément <<button>> dans le document
        let button = document.createElement("button");
        button.id = "fin";

        //exécute la fonction <<productionStop()>> après click sur l'élément <<button>>
        button.addEventListener("click", productionStop());

        //recherche l'élément avec l'id <<buttonContainer>> dans le DOM
        let search = document.getElementById("buttonContainer");

        //ajoute l'élément fils <<button>> à l'élément de l'id correspondant
        search.appendChild(button);

        for (let i = 0; i < début.length; i++) {
            const element = array[i];
            let prodTime = ((fin[i] - début[i])/1000)/60; //en minute
        }

    })

}


function PrixOp(){

}

function PrixProd(){
    
}

function Rendement(){

}

function CadenceProd(){

}

*/

//Script de gestion de l'évenement d'authentification après click

const exampleModal = document.getElementById('exampleModal')
if (exampleModal) {
  exampleModal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an Ajax request here
    // and then do the updating in a callback.

    // Update the modal's content.
    const modalTitle = exampleModal.querySelector('.modal-title')
    const modalBodyInput = exampleModal.querySelector('.modal-body input')

    modalTitle.textContent = `New message to ${recipient}`
    modalBodyInput.value = recipient
  })
}