function Init() {
    var elt = document.getElementById("wlogin");
    elt.onclick = function () {
        var query = {
            login: null,
            pwd: null
        };
        query.login = document.getElementById("identifiant").value;
        query.pwd = md5(document.getElementById("motdepasse").value);
        document.getElementById("return").innerHTML = "Crypted : " + query.pwd;

        if (query.login != "" || query.pwd != ""){
            console.log("-" + JSON.stringify(query));
            getAjax("../../patobeur/ajaxform.php", JSON.stringify(query), function (data) {
                Response(data);
            });
        }else{
            console.log("Pas d'infos ?");
        }
    };
}

function Response(txt) {
    console.log("-" + JSON.stringify(txt));
    if (txt == "ok") {
        console.log("go clearboard()");
        clearboard();
    }else{
        document.getElementById("return").innerHTML = "Error !";
    }
}

function getAjax(url, para, success) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url);
    xhr.onreadystatechange = function () {
        
        document.getElementById("return").innerHTML = "Request :"+ xhr.readyState +"/"+ xhr.status;


        if (xhr.readyState > 3 && xhr.status == 200){
            success(xhr.responseText);
        } else {
            console.log("waiting.....");
        }
    };
    
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("data=" + para);
    return xhr;
}
function clearboard(){
    console.log("ok : clearing");
    document.getElementById("finish").innerHTML = "Bravo !";
}