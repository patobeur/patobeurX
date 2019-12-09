function Init() {
    var compteuse = 0;
    var elt = document.getElementById("wlogin");
    elt.onclick = function () {
        compteuse++;
        var query = {
            login: null,
            pwd: null
        };
        document.getElementById("ninfo").innerHTML = "Essai N°" + compteuse;

        query.login = document.getElementById("identifiant").value;
        query.pwd = md5(document.getElementById("motdepasse").value);
        if (query.login != "" || query.pwd != "") {
            getAjax("./ink/redirform.php", JSON.stringify(query), function (data) {
                Response(data);
            });
        }
    };
}
// ----------------------------------------------------------------
function Response(txt) {
    if (txt == "ok") {
        clearboard();
    }
}
// ----------------------------------------------------------------
function getAjax(url, para, success) {
    let message = '';
    let message2 = '';
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url);
    xhr.onreadystatechange = function () {
        // debug
        switch (xhr.readyState) {
            case 4:
                message = "c'est bon là ? (" + xhr.readyState + ")";
                break;
            case 3:
                message = "Kesako ! (" + xhr.readyState + ")";
                break;
            case 2:
                message = "Kesako ! (" + xhr.readyState + ")";
                break;
            case 1:
                message = "Kesako ! (" + xhr.readyState + ")";
                break;
            default:
                message = "Hum !?! (" + xhr.readyState + ")";
                break;
        }
        switch (xhr.status) {
            case "":
                message2 = "Vide ? Ce n'est pas normal ? (" + xhr.status + ")";
                break;
            case 500:
                message2 = "Bug dans le fichier appelé... (" + xhr.status + ")";
                break;
                case 404:
                    message2 = "Le fichier appelé n'est pas abonné... (" + xhr.status + ")";
                    break;
                case 200:
                    message2 = "C'est good ?? (" + xhr.status + ")";
                    break;
            default:
                message2 = "Hum !?! (" + xhr.status + ")";
                break;
        }
        document.getElementById("readyState").innerHTML = message;
        document.getElementById("status").innerHTML = message2;

        if (xhr.readyState > 3 && xhr.status == 200) {
            success(xhr.responseText);
        }
    };
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("data=" + para);
    return xhr;
}
// ----------------------------------------------------------------
function clearboard() {
    document.getElementById("finish").innerHTML = '<div class="form-page"><div class="formulaire"><a href="http://apteo.org/patobeur/">Bravo !</a></div></div>';
}
Init();