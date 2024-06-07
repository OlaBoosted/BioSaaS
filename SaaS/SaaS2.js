
//alert survenant au click après champs du formulaire complétés

const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
const appendAlert = (message, type) => {
    const wrapper = document.createElement('div')
    wrapper.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible" role="alert">`,
        `   <div>${message}</div>`,
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
    ].join('')

    alertPlaceholder.append(wrapper)
}

const alertTrigger = document.getElementById('liveAlertBtn')
if (alertTrigger) {
    alertTrigger.addEventListener('click', () => {
        appendAlert('Nice, you triggered this alert message!', 'success')
    })
}


//Ajout de la date du jour automatisé dans le champ de formulaire dédié

document.addEventListener("DOMContentLoaded", function () {
    let today = new Date().toISOString().slice(0, 10);
    document.getElementById("day").value = today;
});

//Insertion de valeurs dans l'élément <datalist>

    document.getElementById('myForm').addEventListener('submit', function(event) {
        var form = this;

        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            event.preventDefault(); // Prevent default form submission
            var modal = new bootstrap.Modal(document.getElementById('exampleModal'));
            modal.show();
        }

        form.classList.add('was-validated');
    }, false);

