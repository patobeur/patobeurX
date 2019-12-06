// regles constantes
const unites = ["K", "C", "F"];
let temC, tempK, temF;

function temperature() {
    //
    var Itemperature = traitementtemperature(parseFloat(prompt("Resigner le champ avec une valeur de température", "")));

    if (Itemperature != "" && !isNaN(Itemperature) && Itemperature != false) {
        var Iunite = traitementunite(prompt("Indiquez une unité de temperature : K, C ou F\n\tindiquez la première lettre en Maj", ""), Itemperature, unites);

        if (Iunite != "" && isNaN(Iunite) && Iunite != false) {
            if (log == 1) console.log("coool");
            // ici ça a l'air bon !!! (isNaN ???) avec 1mm * 20000m ça bug ;(
            var perimetre = parseInt(2 * (Distance1.enmetre * Distance2.enmetre));
            // test si tout est bon

            if (!isNaN(perimetre)) {
                alert("2 x ( " + Distance1.enmetre + " x " + Distance2.enmetre + " ) = " + perimetre + " mètre(s)");
            } else {
                retourtemperature();
            }
        } else {
            retourtemperature();
        }
    } else {
        console.log("bug " + isNaN(Itemperature));
        retourtemperature();
    }

}

function traitementunite(inputunite, valuetemp) {

    var resultat = {
        "C": 0,
        "K": 0,
        "F": 0
    };
    if (inputunite != "") {
        switch (inputunite) {
            case "c":
            case "C":
                resultat.C = valuetemp;
                resultat.K = valuetemp + 273.15;
                resultat.F = valuetemp * (9 / 5) + 32;
                break;
            case "k":
            case "K":
                resultat.C = valuetemp - 273.15;;
                resultat.K = valuetemp;
                resultat.F = (valuetemp - 273.15) * 9 / 5 + 32;
                break;
            case "f":
            case "F":
                resultat.C = (valuetemp - 32) * (5 / 9);
                resultat.K = (valuetemp - 32) * (5 / 9) + 273.15;
                resultat.F = valuetemp;
            default:
                break
        }
        return resultat;
    } else {
        return false;
    }
}

function traitementtemperature(valuetemp) {
    if (!isNaN(valuetemp) && valuetemp != "") {
        console.log("ok" + valuetemp);
        return valuetemp;
    } else {
        return false;
    }
}

function retourtemperature(valuetemp) {
    var aurevoir = confirm("Un problème !?! Vous allez quittez l'appli ??");
    if (!aurevoir) {
        temperature();
    }
}