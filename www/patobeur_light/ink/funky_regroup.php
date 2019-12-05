<?php
    if (preg_match( '/ink/' , $_SERVER[ 'REQUEST_URI' ])) {die;}        // on bloque les appels directs
	// --------------------------------------------------------
    // ----------------- A SECURISER DE FOU ! -----------------
    // --------------------------------------------------------
    function COMPILATOR($objet,$what){
        $bloc = '';
        $rep_in = 'in/';
        $passif =  $rep_in.'_in_';
        $actif =  $rep_in.'_ink_';
        //echo $objet['default'][1];

        $bloc .= file_get_contents($passif.'navigation.php',TRUE);

        switch($what){
            case 'index':
                $bloc .= file_get_contents($passif.'landing.php',TRUE);
                $bloc .= file_get_contents($passif.'competences.php',TRUE);
                $bloc .= file_get_contents($passif.'carousel.php',TRUE);
                $bloc .= file_get_contents($passif.'exercices.php',TRUE);
                $bloc .= file_get_contents($passif.'mooks.php',TRUE);
            break;

            case 'ajax':
                $bloc .= file_get_contents($passif.'navigation.php',TRUE);
                $bloc .= file_get_contents($passif.'ajax.php',TRUE);
            break;

            default:
                $bloc .= file_get_contents($passif.'navigation.php',TRUE);
            break;

        }
        // ----------------- A SECURISER DE FOU ! -----------------
        require_once('ink/funky_visitor.php');
        VISITOR();
        $bloc .= preg_replace("_VISITOR_", $_SESSION['TICKET'], file_get_contents($actif.'visitor.php', TRUE));
        $bloc .= file_get_contents($passif.'footer.php',TRUE);
        return $bloc;
    }
?>