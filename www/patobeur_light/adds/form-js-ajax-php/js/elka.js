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
            getAjax("ink/redirform.php", JSON.stringify(query), function (data) {
                Response(data);
            });
        }
    };
}
function Response(txt) {
    if (txt == "ok") {
        clearboard();
    }
}
function getAjax(url, para, success) {
    let message = '';
    let message2 = '';
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url);
    xhr.onreadystatechange = function () {
        if (xhr.readyState > 3 && xhr.status == 200) {
            success(xhr.responseText);
        }
    };
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("data=" + para);
    return xhr;
}
function clearboard() {
    document.getElementById("finish").innerHTML = '<a href="http://apteo.org/patobeur/">Bravo !</a>';
}
Init();