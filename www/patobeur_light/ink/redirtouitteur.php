<?php
    require_once('../../../patobeur/api_touitteur.php');
    if ($retourtouitter){
        header('Content-Type: application/json');
        // if (is_array($retourtouitter)) {
            $retourtouitter = json_decode($retourtouitter, true);
        // }
    }
?>