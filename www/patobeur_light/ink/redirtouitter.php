<?php
    require_once('../../../patobeur/api_touitter.php');
    if ($retourtouitter){
        header('Content-Type: application/json');
        echo $retourtouitter;
    }
?>