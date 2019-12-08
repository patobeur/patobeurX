function LectureFiches() {
    Get_Les_Fiches("ink/redirtouitter.php", '', function (data) {
    // Get_Les_Fiches("ink/patobeurjson.php", '', function (data) {
        Jai_Une_Reponse(data);
    });
}
function Jai_Une_Reponse(Paquet) {
    // 1er palier
    // Paquet = JSON.parse(Paquet);
    // if (Paquet && Paquet.length > 0 ) {
        document.getElementById('status').innerHTML = Paquet.length+" lettre(s)";
        LetGoGoGO(JSON.parse(Paquet));
    // }
}
function LetGoGoGO(Paquet) {
    //  Paquet = JSON.parse(Paquet);
    // if (Paquet && Paquet.length > 0) {
            document.getElementById('readyState').innerHTML = Paquet['messages'].length+" Fiche(s)";
        for (i = 0; i < Paquet['messages'].length; i++){
            IncommingCreator(Paquet['messages'],i);
    // }
}
}


function IncommingCreator(fiche,num) {
    fiche = fiche[num];
    //date et heure du touiite ??


    var divtest = document.createElement("div");
    divtest.className = 'fiche';
    divtest.id = 'touit_'+num;
    rgbautoT(divtest);
    
    texte = '<div class="fichetouit">';
    texte += '<h3>#' + fiche['name'] + '</h3>';
    texte += '<p>Mess: ' + fiche['message']  + '</p>';
    texte += '<p>Likes: ' + fiche['message']  + '</p>';
    texte += '<p>Ip: ' + fiche['ip']  + '</p>';
    texte += '</div>';
    divtest.innerHTML = texte;

    var objTo = document.querySelector('#touittzone');
    objTo.insertBefore(divtest, objTo.childNodes[0]);
}




// ----------------------------------------------------------------
function Get_Les_Fiches(url, para, success) {
    let message = '';
    let message2 = '';
    var PAQUET = new XMLHttpRequest();
    PAQUET.open('POST', url);
    PAQUET.onreadystatechange = function () {
        if (PAQUET.readyState > 3 && PAQUET.status == 200) {
            success(PAQUET.responseText);
        }
    };
    PAQUET.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    PAQUET.send("data=" + para);
    return PAQUET;
}



















document.addEventListener( "DOMContentLoaded", addNewTouit() );
var nbtouit = 0;
var qui = "#Patobeur";
// -----------------------------------------------------------------------------------
function addNewTouit() {
    // waiting for refresh json content
    document.getElementById('retourdebaton').innerHTML = "ok";

    var NewTouiit = document.querySelector("#newtouit");
    NewTouiit.addEventListener("click", clikage);
}

function clikage() {
    nbtouit++;
    // var query = {one: null,two: null};
    var divtest = document.createElement("div");
    divtest.className = "fiche";
    rgbautoT(divtest);
    divtest.innerHTML = creatTouit(qui, fauxtext(hitdice(5, 25)), nbtouit, 'fichetouit', '');

    var objTo = document.querySelector('#touittzone');
    objTo.insertBefore(divtest, objTo.childNodes[0]);
}

// -----------------------------------------------------------------------------------
function creatTouit(qui, message, nbtouit, classe, ide) {
    //date et heure du touiite ??
    if (ide != '') {
        ide = ' id="' + ide + '"';
    }
    if (classe != '') {
        classe = ' class="' + classe + '"';
    }
    document.getElementById('retourdebaton').innerHTML = nbtouit + " déjà touités";
    return '<div' + ide + classe + '><h1>#' + nbtouit + "/" + qui + '</h1><p>' + message + '</p><p></p></div>';

}
// -----------------------------------------------------------------------------------
function fauxtext(nbword) {
    var alphabet = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
    var phrase = '';
    for (i = 0; i < nbword; i++) {
        nblettre = hitdice(2, 9);
        for (j = 0; j < nblettre; j++) {
            phrase += alphabet[hitdice(0, 15)];
        }
        phrase += " ";
    }
    phrase += ".";
    return phrase;
}

function hitdice(min, max) {
    return Math.floor(Math.random(min) * Math.floor(max));
}
// -----------------------------------------------------------------------------------
function rgbauto() {
    return 'rgb(' + hitdice(0, 255) + ',' + hitdice(0, 255) + ',' + hitdice(0, 255) + ')';
}

function rgbautoT(objet) {
    let R = hitdice(0, 255);
    let V = hitdice(0, 255);
    let B = hitdice(0, 255);
    let Nuance = R + V + B;
    let couleur = 'rgba(' + R + ',' + V + ',' + B + ')';
    objet.style.backgroundColor = couleur;
    if (R < 180 && V < 180 && B < 180) {
        objet.style.color = "white";
    }
    let elementa = document.createElement('p');
    elementa.innerHTML = couleur;
    objet.appendChild(elementa);
}

LectureFiches();