//sendeur
document.addEventListener( "DOMContentLoaded", addNewTouit() );
// -----------------------------------------------------------------------------------
function addNewTouit() {  
    var nbtouit = 0;
    var qui = "#Patobeur";
    document.getElementById('retourdebaton').style.backgroundColor = "white";

    var nbfiches = GET_FICHE_ALL();
    const start = Date.now();
    var compteuse = 0;

    var NewTouiit = document.querySelector("#newtouit");
    NewTouiit.addEventListener("click", FauxTouitte);
    // Nouveau message
    var NewMESSAGE = document.getElementById("sandmessage");
    NewMESSAGE.onclick = function (e) {
        var Pseudo = document.getElementById("name").value;
        var Message = document.getElementById("message").value;
        if (Pseudo && Pseudo != "" && Message && Message != ""){
            Pseudo = document.getElementById("name").value;
            Message = document.getElementById("message").value;
            SEND_ONE_FICHE(Pseudo,Message);
        }
    };
    var FauxMessageBTN = document.getElementById("fauxmess");
    FauxMessageBTN.onclick = function (e) {
        FauxMessage();
    };
}
// -----------------------------------------------------------------------------------
function SEND_ONE_FICHE(pseudo,message){    
    SEND_POST_TOUIT("ink/redirtouitteur.php", [pseudo,message], function (data) {
        GET_FICHE_ALL(data);
    });
}// -----------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------
function GET_FICHE_ALL() {
    document.querySelector('#touittzone').innerHTML = "Lecture des fiches !";
    GET_POST_FICHE_ALL("ink/redirtouitter.php", '', function (data) {
        return Jai_Une_Reponse(data);
    });
}
// -----------------------------------------------------------------------------------
function Jai_Une_Reponse(Paquet) {
        document.getElementById('status').innerHTML = Paquet.length+" lettre(s)";
        var NewPaquet = JSON.parse(Paquet);
        
        // if (Paquet && Paquet.length > 0) {
            document.getElementById('readyState').innerHTML = NewPaquet['messages'].length+" Fiche(s)";
            //var acteurs = lesacteurs(Paquet);
            for (i = 0; i < NewPaquet['messages'].length; i++){
                IncommingCreator(NewPaquet['messages'],i);
            }
        // }
        return Paquet.length;
}
function FauxTouitte() {
    nbtouit++;
    // var query = {one: null,two: null};
    var divtest = document.createElement("div");
    divtest.className = "fiche";
    divtest.innerHTML = creatTouit(qui, fauxtext(HitDice(5, 25)), nbtouit, 'fichetouit', '');

    var objTo = document.querySelector('#touittzone');
    objTo.insertBefore(divtest, objTo.childNodes[0]);
}

function FauxMessage() {
    document.querySelector('#name').value = fauxtext(HitDice(1, 10))
    document.querySelector('#message').value = fauxtext(HitDice(1, 10))
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
// -----------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------

// -----------------------------------------------------------------------------------
function heure()
{
        var date = new Date();
        var heure = date.getHours();
        var minutes = date.getMinutes();
        if(minutes < 10)
            minutes = "0" + minutes;
        return heure + "h" + minutes;
}
// -----------------------------------------------------------------------------------
function SEND_POST_TOUIT(url, para, success) {
    let message = '';
    let message2 = '';
    var PAQUET = new XMLHttpRequest();
    PAQUET.open('POST', url);
    PAQUET.onreadystatechange = function () {
        // debug
        switch (PAQUET.readyState) {
            case 4:
                message = "DONE ! (" + PAQUET.readyState + ")";
                break;
            case 3:
                message = "LOADING ! (" + PAQUET.readyState + ")";
                break;
            case 2:
                message = "HEADERS_RECEIVED ! (" + PAQUET.readyState + ")";
            break;
            case 1:
                message = "OPENED ! (" + PAQUET.readyState + ")";
                break;
            case 0:
                message = "UNSENT ! (" + PAQUET.readyState + ")";
                break;
            default:
                message = "Hum !?! (" + PAQUET.readyState + ")";
                break;
        }
        switch (PAQUET.status) {
            case "":
                message2 = "Vide ? Ce n'est pas normal ? (" + PAQUET.status + ")";
                break;
            case 500:
                message2 = "Bug dans le fichier appelé... (" + PAQUET.status + ")";
                break;
                case 404:
                    message2 = "Le fichier appelé n'est pas abonné... (" + PAQUET.status + ")";
                    break;
                case 200:
                    message2 = "C'est good ?? (" + PAQUET.status + ")";
                    break;
            default:
                message2 = "Hum !?! (" + PAQUET.status + ")";
                break;
        }
        document.getElementById("one").innerHTML = message;
        document.getElementById("two").innerHTML = message2;

        if (PAQUET.readyState > 3 && PAQUET.status == 200) {
            success(PAQUET.responseText);
        }
    };
    PAQUET.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    console.log('js:' + url + "?name=" + para[0] + "&message=" + para[1]);
    PAQUET.send("name=" + para[0] + "&message=" + para[1] + "[" + heure() + "]");
    return PAQUET;
}
// -----------------------------------------------------------------------------------
function quialea(){    
    let auteurs = [
        'Pato',
        'C.A.R. Hoare',
        'Auteur Inconnu',
        'Gerald Weinberg',
        'Edsger Dijkstra',
        'Jeremy S. Anderson'
    ];
    let phrases = [
        'From Outer Spaces',
        'Il y existe deux manières de concevoir un logiciel. La première, c’est de le faire si simple qu’il est évident qu’il ne présente aucun problème. La seconde, c’est de le faire si compliqué qu’il ne présente aucun problème évident. La première méthode est de loin la plus complexe',
        'Le fossé séparant théorie et pratique est moins large en théorie qu’il ne l’est en pratique',
        'Si les ouvriers construisaient les bâtiments comme les développeurs écrivent leurs programmes, le premier pivert venu aurait détruit toute civilisation',
        'Si debugger, c’est supprimer des bugs, alors programmer ne peut être que les ajouter',
        'Les deux principales inventions sorties de Berkeley sont UNIX et le LSD. Difficile de croire à une quelconque coïncidence'
    ];
    let N = HitDice(0,phrases.length);
    console.log(N);
    document.querySelector("#name").value = auteurs[N];
    document.querySelector("#message").innerHTML = phrases[N];
}
// -----------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------


// -----------------------------------------------------------------------------------
// function lesacteurs(Paquet){
//     Paquet = Paquet['messages'];
//     var names = ["moi"];
//     var comptes = [0];
//     var newname = false;
//     for (i = 0; i < Paquet.length; i++){
//         newname = false;
//         var name = Paquet[i]['name'];
//         for (j=0; j < names.length; j++){
//             console.log("test:"+name);
//             if (names[j]==name){
//                 newname = true;
//                 comptes[j] = comptes[j] + 1;
//                 break;
//             }
//         }
//             if (newname == false){
//                 console.log("new:"+name);
//                 names.push(name);
//                 comptes.push(0)
//             }
//     }
//     return names;
// }
// ----------------------------------------------------------------
function IncommingCreator(fiche,num) {
    fiche = fiche[num];
    //date et heure du touiite ??

    var divtestin = document.createElement("div");
    divtestin.className = 'fichetouit';
    //rgbautoT(divtestin); // couleur aleatoire   
    texte = '<h3 style="'+rgbauto()+'">#' + fiche['name'] + '</h3>';
    texte += '<p>Mess: ' + fiche['message']  + '</p>';
    texte += '<p>( ' + fiche['likes']  + ' Likes) [Ip: ' + fiche['ip']  + ']</p>';
    texte += '<div class="addlike">+</div>';
    texte += '<div class="addcomment">+</div>';
    divtestin.innerHTML = texte;

    var divtest = document.createElement("div");
    divtest.className = 'fiche';
    divtest.id = 'touit_'+num; 
    divtest.insertBefore(divtestin, divtest.childNodes[0]);

    var objTo = document.querySelector('#touittzone');
    objTo.insertBefore(divtest, objTo.childNodes[0]);
    //return fiche['name'];
}
// ----------------------------------------------------------------
function GET_POST_FICHE_ALL(url, para, success) {
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
    
    quialea();
    document.getElementById('retourdebaton').innerHTML = "Salut !";
    return PAQUET;
}
// ----------------------------------------------------------------
// -----------------------------------------------------------------------------------
function fauxtext(nbword) {
    var alphabet = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
    var phrase = '';
    for (i = 0; i < nbword; i++) {
        nblettre = HitDice(2, 9);
        for (j = 0; j < nblettre; j++) {
            phrase += alphabet[HitDice(0, 15)];
        }
        phrase += " ";
    }
    phrase += ".";
    return phrase;
}

function HitDice(min, max) {
    return Math.floor(Math.random(min) * Math.floor(max));
}
// -----------------------------------------------------------------------------------
function rgbauto() {
    let R = HitDice(0, 255);
    let V = HitDice(0, 255);
    let B = HitDice(0, 255);
    let message = 'background-color:rgb(' + R + ',' + V + ',' + B + ')';
    console.log(R + V + B);
    if ((R + V + B) < 550) {
        message += ";color:Black";
    }
    message += ')';
    return message;
}

function rgbautoT(objet) {
    let R = HitDice(0, 255);
    let V = HitDice(0, 255);
    let B = HitDice(0, 255);
    let Nuance = R + V + B;
    let couleur = 'rgba(' + R + ',' + V + ',' + B + ')';
    objet.style.backgroundColor = couleur;
    // if (R < 200 && V < 200 && B < 200) {
    if (R + V + B < 550) {
        objet.style.color = "white";
    }
    let elementa = document.createElement('p');
    elementa.innerHTML = couleur;
    objet.appendChild(elementa);
}
