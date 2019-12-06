<?php
    $query = json_decode($_POST["data"]);
    if ($query->pwd == md5("Admin")){
        echo "ok";
    }
?>