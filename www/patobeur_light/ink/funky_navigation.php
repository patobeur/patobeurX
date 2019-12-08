<?php
    if (preg_match( '/ink/' , $_SERVER[ 'REQUEST_URI' ])) {die;}    // on bloque les appels directs    
    // -----------------------------------------------------------------------------------------------------------------------
	function Navigat($ARRRAIEE,$kelfamille){
        $n=PHP_EOL;
        $fichier_importe = file_get_contents('in/_in_navigation.php',TRUE).$n;
        // ------------------------------------------------------------------------------
        $blocm = OkSpacer(4)."<!-- Auto in menu -->".$n;
        for ($oo=0; $oo < count($ARRRAIEE[$kelfamille]); $oo++){
            // ici le lien active
            if ($_SESSION['CURR_PAGE'] == $ARRRAIEE[$kelfamille][$oo]) {$active = ' active';} else  {$active = '';}
            $blocm .= OkSpacer(4).'<a class="dropdown-item'.$active.'" href="?'.$ARRRAIEE[$kelfamille][$oo].'">'.$ARRRAIEE[$ARRRAIEE[$kelfamille][$oo]]['title'].'</a>'.$n;
        } 
        $blocm .= OkSpacer(4)."<!-- Fin Auto in menu -->";
        if ($_SESSION['CURR_PAGE'] == 'index') {$ISACTIF = ' active';} else  {$ISACTIF = '';}
        $valeurderetour = preg_replace("_NAVIGATATOR_",$blocm, $fichier_importe); 
        $valeurderetour = preg_replace("_ACTIVITE_",$ISACTIF, $valeurderetour);        
        // ------------------------------------------------------------------------------
        $valeurderetour = preg_replace('_ACTOBEURTWO_',Menu_Genatobeur($ARRRAIEE,'pagesgestion','files'), $valeurderetour);
        $valeurderetour = preg_replace('_ACTOBEUR_',Menu_Genatobeur($ARRRAIEE,'pagesext','files'), $valeurderetour);
        // ------------------------------------------------------------------------------
        return $valeurderetour; 
    }
    function Menu_Genatobeur($ARRRAIEE,$kelfamille,$sousfamille){        
        $Tablo_Familles = $ARRRAIEE[$kelfamille];
        $Tablo_Enfants = $Tablo_Familles[$sousfamille];
        $A_nom_menu = $ARRRAIEE[$kelfamille]['nommenu'];
        $A_nom_label = $ARRRAIEE[$kelfamille]['nomlabel']; 
        // ------------------------------------------------------------------------------
        $n=PHP_EOL;
        $A_remplacement = '';
        for ($oo=0; $oo < count($Tablo_Enfants); $oo++){
            // ici le lien active
            $target='';
            if ($Tablo_Enfants[$oo]['target']!='') $target=' target="'.$target.'"';
            $A_remplacement .= OkSpacer(0,5).'<a class="dropdown-item" href="'.$Tablo_Enfants[$oo]['href'].'"'.$target.'>'.$Tablo_Enfants[$oo]['title'].'</a>'.$n;
        } 
        // ------------------------------------------------------------------------------
        $A_retour ='Vide';
        $A_plop = '                                <!-- Auto out menu -->
                                <li class="nav-item dropdown">
                                    <a
                                        class="nav-link dropdown-toggle"
                                        href="#"
                                        id="'.$A_nom_label.'"
                                        role="button"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">'.$A_nom_menu.'</a>
                                    <div class="dropdown-menu" aria-labelledby="'.$A_nom_label.'">
                                        <!-- Auto out '.$A_nom_menu.' -->
MENUACTOBEUR                                        <!-- Fin out '.$A_nom_menu.' -->
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item">End</a>
                                    </div>
                                </li>
                                <!-- Fin Auto out menu -->';
        // ------------------------------------------------------------------------------
        if ($A_remplacement!="") {
            $A_retour = preg_replace('_MENUACTOBEUR_',$A_remplacement, $A_plop);
        }
        // ------------------------------------------------------------------------------
        return $A_retour;
    }
?>