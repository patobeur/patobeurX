<?php
// if (preg_match( '/ink/' , $_SERVER[ 'REQUEST_URI' ])) {die;}        // on bloque les appels directs
// if (stripos($_SERVER['REQUEST_URI'], "") || !isset($_POST) || !isset($_POST['identifiant']) || !isset($_POST['motdepasse'])) {
//     header("Location: ../index.html");
// }
if(isset($_POST) && isset($_POST['identifiant']) && isset($_POST['motdepasse'])){
    $query = json_decode($_POST["data"]);
    $query->good = md5("HotPass");
    $query->success = false;
    if ($query->pwd == $query->good){
        $query->success = true;
        echo "Ok!";}
    else{
        echo "..";
    }
}
?>