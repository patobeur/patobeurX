function perimetre() {
    // regles
    var unites = ["mm", "dm", "cm", "m"];
    var ratio = ["1000", "100", "10", "1"];
    //
    var Distance1 = traitement(prompt("indiquez une longueur positive en m, dm, cm ou mm (exemple 2m, 27cm, 246dm ou encore 652mm", ""),unites,ratio);
    if (Distance1 != false) {
        var Distance2 = traitement(prompt("indiquez une largeur positive en m, dm, cm ou mm (exemple 3m, 27cm, 246dm ou encore 652mm", ""),unites,ratio);
        if (Distance2 != false) {
            if (log == 1) console.log("longueur en metre = " + Distance1.enmetre);
            if (log == 1) console.log("largeur en metre = " + Distance2.enmetre);
            // ici ça a l'air bon !!! (isNaN ???) avec 1mm * 20000m ça bug ;(
            var perimetre = parseInt(2*(Distance1.enmetre * Distance2.enmetre));
            // test si tout est bon
            if (!isNaN(perimetre)) {
                document.getElementById("dernierperimetre").innerHTML = "2 x ( " + Distance1.enmetre + " x " + Distance2.enmetre + " ) = " + perimetre + " mètre(s)";
                alert("2 x ( " + Distance1.enmetre + " x " + Distance2.enmetre + " ) = " + perimetre + " mètre(s)");
            } else {retour();}
        }else {retour();}
    }
    else {retour();}

}
function retour(){    
    var aurevoir = confirm("Un problème !?! Vous allez quittez l'appli ??");
    if (!aurevoir) {
        perimetre();
    }
}
function traitement(Long = 0, unites, ratio) {
    // je traite chaque envoi dans une fonction c'est mieu !et je crée un petit "objet" de voyage Distance[] 
    var Distance = {
        "distance": 0,
        "ratio": 0,
        "unite": "m",
        "enmetre": 0
    }
    for (i = 0; i < unites.length; i++) {
        // je boucle sur toute les unité dispo / 4
        if (Long.indexOf(unites[i]) > -1) { // si je trouve une unité connue dans le input je le capte
            Distance.ratio = ratio[i]; // je prend les datas
            Distance.unite = unites[i]; // je prend les datas
            Distance.distance = parseInt(Long.trim(Long.replace(unites[i], "")), 10); // j'enleve les espaces et l'unité du coup à grand coup de replace() et je colle un parseInt pour avoir du numérique
            Distance.enmetre = Distance.distance / ratio[i]; // je remet en mètres

            if (log == 1) console.log("valeur : " + Long.indexOf(unites[i]) + " " + Distance.unite);
            if (log == 1) console.log("Distance -> " + Distance.distance + Distance.unite + " / " + Distance.ratio + " = " + Distance.enmetre + "mètre");
            break; // j'arette là pour eviter des erreurs sur d'autre lettres genre m pour mm
        }
    }
    if (Distance.enmetre > 0) {
        return Distance;
    } else {
        return false;
    }
}