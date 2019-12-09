//sendeur

var compteuse = 0;
var Pseudo = document.getElementById("pseudo").value;
var Message = document.getElementById("message").value;

document.querySelector('#sandmessage').addEventListener("click", function(){ 
    if (Pseudo && Pseudo != "" && Message && Message != ""){
    console.log(Pseudo + " " +Message);
        sendmessage(Pseudo,Message);
    }
}); 


function sendmessage(pseudo,message){
    let Url = "ink/redir_api_touitter.php";
    EnvoyerUnMessage(Url, [pseudo,message], function (data) {
            JaiLaReponse(data);
        }
    );
}
// ----------------------------------------------------------------
function EnvoyerUnMessage(url, para, success) {
    let message = '';
    let message2 = '';
    var PAQUET = new XMLHttpRequest();
    PAQUET.open('POST', url);
    console.log("post");

    PAQUET.onreadystatechange = function () {
        // debug
        switch (PAQUET.readyState) {
            case 4:
                message = "c'est bon là ? (" + PAQUET.readyState + ")";
                break;
            case 3:
                message = "Kesako ! (" + PAQUET.readyState + ")";
                break;
            case 2:
                message = "Kesako ! (" + PAQUET.readyState + ")";
                break;
            case 1:
                message = "Kesako ! (" + PAQUET.readyState + ")";
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
        document.querySelector('#one').innerHTML = message;
        document.querySelector('#two').innerHTML = message2;

        if (PAQUET.readyState > 3 && PAQUET.status == 200) {
            success(PAQUET.responseText);
        }
    };
    PAQUET.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    // PAQUET.setRequestHeader("Content-Type", "multipart/form-data");
    // PAQUET.setRequestHeader("Content-Type", "text/plain");
    console.log( url + "?name=" + para[0] + "&message=" + para[1]);
    PAQUET.send("name=" + para[0] + "message=" + para[1]);
    return PAQUET;
}
function JaiLaReponse(Paquet) {
    // Paquet = JSON.parse(Paquet);
    // if (Paquet && Paquet.length > 0 ) {
        document.getElementById('three').innerHTML = Paquet.length + " lettre(s)";
        // console.log(JSON.parse(Paquet));
        console.log("retour: "+Paquet);
    // }
}















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
    // if (Paquet && Paquet.length > 0) {
        document.getElementById('readyState').innerHTML = Paquet['messages'].length+" Fiche(s)";
        
        //var acteurs = lesacteurs(Paquet);

        for (i = 0; i < Paquet['messages'].length; i++){
            IncommingCreator(Paquet['messages'],i);
        }
    // }
}
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


function IncommingCreator(fiche,num) {
    fiche = fiche[num];
    //date et heure du touiite ??

    var divtestin = document.createElement("div");
    divtestin.className = 'fichetouit';
    rgbautoT(divtestin); // couleur aleatoire   
    texte = '<h3>#' + fiche['name'] + '</h3>';
    texte += '<p>Mess: ' + fiche['message']  + '</p>';
    texte += '<p>( ' + fiche['likes']  + ' Likes) [Ip: ' + fiche['ip']  + ']</p>';
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

















