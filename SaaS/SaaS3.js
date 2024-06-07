//Script de suppression d'item(s)

function erase() {
    let datalist = document.getElementById('dataOpt2');
    let suppress = document.getElementsById("Prod").value;
    let items = document.getElementsByTagName('option');
    let nbreItems = items.length;
    
    for (i = 0; i = nbreItems; i++) {
        if (items[i].value === suppress) {
            datalist.removeChild(items[i]);
            break;
        }
    }
}


//Script d'ajout d'item(s)
function add() {
    let more = document.getElementById('Prod').value;
    let dataList = document.getElementById('dataOpt2');
    let items = dataList.getElementsByTagName('option');

    let itemExists = false;

    for (let i = 0; i < items.length; i++) {
        if (items[i].value === more) {
            itemExists = true;
            break;
        }
    }

    //Vérifie si l'item etait déjà dans liste
    if (!itemExists && more) { 
        let newOption = document.createElement('option');
        newOption.value = more;
        dataList.appendChild(newOption);
    }
}
