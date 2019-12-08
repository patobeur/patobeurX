const exemple = "";

function serialcheck() {

    traitementserial(prompt("Numéro de serie ? N'oubliez pas les tirets.", exemple));

}

function traitementserial(BrutSerial) {
    if (BrutSerial) {
        goConsole(BrutSerial,log);
        var objSerial = BrutSerial.split("-");
        goConsole("nombre de bloc : " + objSerial.length,log);
        goConsole("longueur du string : " + BrutSerial.length,log);

        if (BrutSerial != "" && BrutSerial.length == 19 && objSerial.length == 4 && allnum(objSerial) == 0 && regles4(Fantastik4) == ObjSerial[1] ) {

            // le formatage est bon on passe à la verification des règles
            checking(objSerial);

        } else {
            alert("Mauvais code !");
        }
    }
}

function checking(ObjSerial) {

    goConsole("test1 si " + ObjSerial[0] + "==" + ObjSerial[2].split("").reverse().join(""), log);

    goConsole("test2 si " + ObjSerial[1] + "==" + regles4(ObjSerial[2]),log);

    if ((ObjSerial[0] == ObjSerial[2].split("").reverse().join("")) && (ObjSerial[1] == regles4(ObjSerial[2]))) {
        goConsole("ok",log);
        alert("Merci ! Votre 'Serialnumber' est validé !",log);
    } else {
        goConsole("Erreur de numéro de serie ! Contactez votre DSI",log);
        retour();
    }
}

function allnum(ObjSerial) {
    for (i = 0; i < ObjSerial.length; i++) {
        // si non numérique ? 
        if (!isNaN(parseInt(ObjSerial[i], 10))) break;
    }
    return i;
}

function regles4(Fantastik4) {
    var temCalc = Fantastik4 * 7;
    temCalc = temCalc.toString().substring(1, temCalc.length);
    goConsole(temCalc,log);
    return temCalc;


}

function retour() {
    var aurevoir = confirm("Erreur ! Contactez votre DSI !");
    if (!aurevoir) {
        serialcheck();
    }
}