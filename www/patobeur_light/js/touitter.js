document.addEventListener("DOMContentLoaded", addNewTouit())
    var nbtouit = 0;
    var qui = "#Patobeur";
// -----------------------------------------------------------------------------------
function addNewTouit() {
    // waiting for refresh json content
    document.getElementById('console').innerHTML = "ok";

    var NewTouiit = document.querySelector("#newtouit");
    NewTouiit.addEventListener("click", clikage);
}

function clikage(){
    nbtouit++;
    // var query = {one: null,two: null};
    var divtest = document.createElement("div");
    divtest.className = "fiche";
    rgbautoT(divtest);
    divtest.innerHTML = creatTouit(qui,fauxtext(hitdice(5,25)),nbtouit,'fichetouit','');

    var objTo = document.querySelector('#touittzone');
    objTo.insertBefore(divtest,objTo.childNodes[0]);
}

// -----------------------------------------------------------------------------------
function creatTouit(qui,message,nbtouit,classe,ide){
    //date et heure du touiite ??
    if (ide!=''){ide =' id="'+ide+'"';}
    if (classe!=''){classe=' class="'+classe+'"';}
    document.getElementById('console').innerHTML = nbtouit + " déjà touités";
    return '<div'+ide+classe+'><h1>#'+nbtouit+"/"+qui+'</h1><p>'+message+'</p><p></p></div>';

}
// -----------------------------------------------------------------------------------
function fauxtext(nbword){
    var alphabet = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
    var phrase = '';
    for (i = 0; i < nbword; i++){
        nblettre = hitdice(2,9);
        for (j=0; j < nblettre; j++){
            phrase += alphabet[hitdice(0,15)];
        }
        phrase += " ";
    }
    phrase += ".";
    return phrase;
}
function hitdice(min,max) {
    return Math.floor(Math.random(min) * Math.floor(max));
}
// -----------------------------------------------------------------------------------
function rgbauto() {
    return 'rgb('+hitdice(0,255)+','+hitdice(0,255)+','+hitdice(0,255)+')';
}
function rgbautoT(objet) {
    let R = hitdice(0,255);
    let V = hitdice(0,255);
    let B = hitdice(0,255);
    let Nuance = R+V+B;
    let couleur = 'rgba('+R+','+V+','+B+')';
    objet.style.backgroundColor = couleur;
    if (R < 180 && V < 180 && B < 180) {
        objet.style.color = "white";
    }
    let elementa = document.createElement('p');
    elementa.innerHTML = couleur;
    objet.appendChild(elementa);
}
