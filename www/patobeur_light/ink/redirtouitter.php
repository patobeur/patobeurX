<?php
    require_once('../../../patobeur/touitter.php');
    if ($retourtouitter){
        header('Content-Type: application/json');
        echo $retourtouitter;
    }
?>