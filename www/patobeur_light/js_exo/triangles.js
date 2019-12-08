// A boire !
// 
function triangles() {

    cote = prompt("Alors ? un entier ?", "10")
    if (!isNaN(cote) && cote != "" && parseInt(cote) > 0) {
        //DrawRectTriangle(cote);
        DrawIsoTriangle(cote);
    } else {
        retour();
    }

}

function DrawRectTriangle(uncote) {
    let temi = '';
    for (i = 1; i <= uncote; i++) {
        temi = '';
        for (j = 1; j <= i; j++) {
            temi = temi + "*";
        }
        goConsole(temi, log);
    }


}

function DrawIsoTriangle(uncote) {
    let marginmax = uncote / 2;
    let temi = '';
    let space = '';

    for (i = 1; i <= uncote; i++) { // ligne by ligne !!
        space = '';
        for (j = 0; j <= (parseInt(uncote) - i); j++) {
            //space = j + space;
            space = space + " ";
        }
        temi = '';
        for (k = 0; k <= i + 2; k++) {
            temi = temi + "*";
        }
        goConsole(space + temi, log);
    }


}

function retour() {
    var aurevoir = confirm("Erreur ! Contactez votre barman !");
    if (!aurevoir) {
        triangles();
    }
}