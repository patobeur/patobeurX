function Init() {
    var elt = document.getElementById("wlogin");
    elt.onclick = function () {
        var query = {
            login: null,
            pwd: null
        };
        query.login = document.getElementById("identifiant").value;
        query.pwd = md5(document.getElementById("motdepasse").value);
        if (query.login != "" || query.pwd != ""){
            getAjax("ink/ajaxform.php", JSON.stringify(query), function (data) {
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
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url);
    xhr.onreadystatechange = function () {        
        //document.getElementById("return").innerHTML = "Request :"+ xhr.readyState +"/"+ xhr.status;
        if (xhr.readyState > 3 && xhr.status == 200){
            success(xhr.responseText);
        }
    };    
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("data=" + para);
    return xhr;
}
function clearboard(){
    document.getElementById("finish").innerHTML = '<div class="form-page"><div class="formulaire">Bravo !</div></div>';
}