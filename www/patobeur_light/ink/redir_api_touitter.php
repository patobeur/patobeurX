<?php
    require_once('../../../patobeur/api_touitter_hot.php');
    if ($retourtouitter){
        header('Content-Type: application/json');
        echo $retourtouitter;
    }
?>