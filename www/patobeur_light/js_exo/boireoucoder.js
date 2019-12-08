// A boire !
// 
function BoireOuCoder() {
    NbVerres = prompt("Alors ? Combien de verre se soir ?", "")
    if (!isNaN(NbVerres) && NbVerres != "" && parseInt(NbVerres) > 0) {

        //NbVerres = parseInt(NbVerres); // un entier c'est mieux, au cas ou !
        let ardoise = new Array(); // new Array(new Array(0,0));
        let tournee = 0;
        let numeroVerredEau = 5;
        let nbverres = 0;
        let eau = 0;

        for (i = 0; i < NbVerres; i++) {
            eau = 0; // 0 verre d'eau pour le console.log
            nbverres++; // JE BOIS UN VERRE DE PLUS
            if (nbverres == numeroVerredEau) { // SI J'EN SUIS AU VERRE D'EAU
                tournee = tournee + 1; // je passe a une autre tournée ! 
                eau = 1; // 1 verre d'eau pour le console.log
                nbverres = 0; // je reinitialise le nb de verre
                ardoise[i] = new Array(tournee, nbverres, eau); // on rajoute sur l'ardoise
            } // else {}
            ardoise[i] = new Array(tournee, nbverres, eau); // on rajoute sur l'ardoise
        }
        let derniersverres = parseInt(parseInt(i) - (parseInt(tournee) * parseInt(numeroVerredEau))); // edition de la soirée passage à la caisse

        for (j = 1; j < NbVerres; j++) {
            //goConsole("Tournée: " + ardoise[j][0] + " alcool: " + ardoise[j][1] + " eau: " + ardoise[j][2] + " ", log);
        }
        goConsole(i + " Tournée(s) avec " + (parseInt(parseInt(i) - derniersverres - tournee)) + " verre(s) d'alcool", log);
        goConsole("Buvez avec modération plutôt que seul !", log);
    } else {
        retour();
    }
}

function retour() {
    var aurevoir = confirm("Erreur ! Contactez votre barman !");
    if (!aurevoir) {
        BoireOuCoder();
    }
}

// info utiles et sympa ;)

// https://www.toutjavascript.com/savoir/savoir09.php3

// Ajouter/supprimer des éléments au tableau
// Les méthodes push() et unshift ajoutent des éléments respectivement en fin et en début de tableau.
// Les méthodes pop() et shift() suppriment respectivement le dernier et le premier élément du tableau.
// La concaténation de tableaux comme pour les chaînes, il est possible de concaténer plusieurs tableaux pour n'en former qu'un seul. La fusion se fait avec concat().

// Un nouveau tableau d'animaux est déclaré au format JSON puis il est concaténé au tableau animaux du début de cette page : 
// var animaux2 = [
//     {"nom": "Dumbo", "espece": "Eléphant", "age": 50},
//     {"nom": "Booba", "espece": "Ours", "age": 8}
//    ];
//    var tousMesAnimaux=animaux.concat(animaux2);
//    document.write(tousMesAnimaux.length);

// enoooOOOOOoooOOOooOOOOOORME

// JavaScript propose des méthodes de tri de tableaux puissantes.
// Utilisons notre tableau des mois de l'année et trions le par ordre alphabétique avec sort().
// var mois=["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"];
// document.write("Affichage du tableau avant le tri :<br>");
// document.write(mois.join(", "));
// /* Tri du tableau */
// mois.sort();
// document.write("<hr>Affichage du tableau trié :<br>");
// document.write(mois.join(", "));
// /* Inversion du tableau */
// mois.reverse();
// document.write("<hr>Affichage du tableau inversé :<br>");
// document.write(mois.join(", "));

// A l'exécution, le tableau mois est trié.
// Affichage du tableau avant le tri :
// Janvier, Février, Mars, Avril, Mai, Juin, Juillet, Août, Septembre, Octobre, Novembre, DécembreAffichage du tableau trié :
// Août, Avril, Décembre, Février, Janvier, Juillet, Juin, Mai, Mars, Novembre, Octobre, SeptembreAffichage du tableau inversé :
// Septembre, Octobre, Novembre, Mars, Mai, Juin, Juillet, Janvier, Février, Décembre, Avril, Août 