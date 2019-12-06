/* fonction pour passer des euros en dollars 
version input et document.getElementById()
 - - - - - - - - - - - - - - - - */
 function conv_dollars2euros() {
    var change = 1.10;
    var euros = document.getElementById("champs1").value;
    if (euros) {
        var change = 1.10;
        var dollars = 0;
        if (!isNaN(euros)) {
            alert(euros);
            dollars = euros * change;
            document.getElementById("champs2").value = dollars.toFixed(2);
        } else {
            alert('ceci n\'est pas un nombre correct !');
        }
    } else {
        document.getElementById("champs2").value = "";
        alert('Le champs est vide !');
    }
}
/* fonction pour passer des euros en dollars 
version alerte et prompt
 - - - - - - - - - - - - - - - - */
function prompt_dollars2euros() {
    var change = 1.10;
    var euros = prompt("Entrez une valeur en Euros", "");
    if (euros) {
        var dollars = 0;
        if (!isNaN(euros)) {
            dollars = euros * change;
            alert('Cela vous fait la belle somme de ' + dollars.toFixed(2) + "$");
        } else {
            alert('ceci n\'est pas un nombre correct !');
        }
    } else {
        document.getElementById("champs2").value = "";
        alert("Le champs est vide !");
    }
}