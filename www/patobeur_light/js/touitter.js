document.addEventListener("DOMContentLoaded", addTouit())
function addTouit() {
    document.getElementById('console').innerHTML = "ok";
}
function addcoucou(name, message) {
    document.getElementById('console').innerHTML = "coucou";
    
}
function creatTouit(w,x){
    let = blochtml = '<div class="fichetouit"><h1>'+w+'</h1><p>'+x+'</p></div>';
}


var elt = document.getElementById("newtouit");
elt.onclick = function () {
    // var query = {
    //     login: null,
    //     pwd: null
    // };
    // nodee = document.getElementById('touittzone')
    let tm = creatTouit('Moi','coucou');
    document.getElementById('touittzone').appendChild(tm); 
};