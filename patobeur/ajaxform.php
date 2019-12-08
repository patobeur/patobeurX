<?php
$value = '';
if(isset($_POST) || isset($_POST['data'])){
    $query = json_decode($_POST["data"]);
    if ($query->pwd == md5("Admin") && $query->login =="Admin"){
        $value = "ok";
    }
}
?>