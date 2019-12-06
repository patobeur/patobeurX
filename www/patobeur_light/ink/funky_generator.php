<?php
	if (preg_match( '/ink/' , $_SERVER[ 'REQUEST_URI' ])) {die;}                        // on bloque les appels directs
    $Bloc_HTML_json_arr = file_get_contents("../../patobeur/patobeur_header.json");		// ICI LE NOM Du FICHIER JSON sur la STRUCTURE HTML
	$Structure_json_arr = json_decode($Bloc_HTML_json_arr,true);                        // on transform en un beau tableau exploitable
    // -----------------------------------------------------------------------------------------------------------------------	
	$auteur =           $Structure_json_arr['auteur'];                                  // juste pour faire genre
    $date =             $Structure_json_arr['date'];
    $time_stamp =       $Structure_json_arr['time_stamp'];
    // -----------------------------------------------------------------------------------------------------------------------
	// One to rule them all ! Or not ;(
    // -----------------------------------------------------------------------------------------------------------------------
	function Gen_DOM($contentpages,$objet,$koi,$choix){
        
        $Posted = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        // ----------------- A SECURISER DE FOU ! -----------------
        $defaultpage = $objet['defaultpage'][0];                        // page par default
        $pagesacceptees = $objet['pages'];                              // les pages sont dans le json a la section pages et en dessous
        // -------------------- ici un peu le bordel mais je tricotte là ------------------------------------
        for ($i=0; $i < count($objet['pages']); $i++){                  // on prend la liste des page existante dans le json
            if (preg_match("'".$objet['pages'][$i]."'",$Posted)){       // la page est elle dans l'url ??
                $defaultpage = $pagesacceptees[$i];                     // si oui on prend le nom dans $what 
                // break;                                               // on stop ou pas 
            }
        }



        $n=PHP_EOL;$bloc="";
        $bloc .= Gen_Page_Top($objet,$koi,$choix,0);
        $bloc .= Gen_BODY($defaultpage,$contentpages,$objet,$koi,$choix,0);
        return $bloc;
    }
    // -----------------------------------------------------------------------------------------------------------------------
	function Gen_Page_Top($objet,$koi,$choix,$Origine){
        $n=PHP_EOL;$bloc="";
        if (isset($objet[$koi][$choix]['doctype'])){              $bloc .=        $objet[$koi][$choix]['doctype'].$n;}
        if (isset($objet[$koi][$choix]['lang'])){                 $bloc .=        $objet[$koi][$choix]['lang'].$n;}

        $bloc .= Gen_META($objet,'head',"meta","head",$Origine);
		return $bloc;
    }
    // -----------------------------------------------------------------------------------------------------------------------
    
    // -----------------------------------------------------------------------------------------------------------------------
    // Point G.culture
    // un post sympa sur le json et le javascript
    // https: //openclassrooms.com/forum/sujet/jquery-utiliser-un-json-cree-avec-php
	// -----------------------------------------------------------------------------------------------------------------------
    function Gen_BODY($defaultpage,$contentpages,$objet,$koi,$choix,$Origine=0){
        $n=PHP_EOL;$bloc="\n";
        $bloc .= Spacer($Origine,1).'<body>'.$n;
        $bloc .= Spacer($Origine,2).'<div class="fullpage">'.$n;
        // -------------------------------------- 
        $rootpassif =  'in/_in_';
        $rootactif =  'in/_ink_';
        $pageextension = ".php";            // utiles pour le file_get_contents plus bas
        // -------------------------------------- 
        
        // $bloc .= file_get_contents($rootpassif.'navigation.php',TRUE); // ici on integre la navigation 
        // -------------------------------------- 
        // generation des pages a integrer dans le body en dessous de navigation mais en dessus du footer

        // BUGG ICI BUGG ICI BUGG ICI BUGG ICI BUGG ICI BUGG ICI BUGG ICI 
        // BUGG ICI BUGG ICI BUGG ICI BUGG ICI BUGG ICI BUGG ICI BUGG ICI 
        // BUGG ICI BUGG ICI BUGG ICI BUGG ICI BUGG ICI BUGG ICI BUGG ICI 
        $tempovalue = count($objet[$defaultpage]['blocs']);
        for ($nbfichier = 0; $nbfichier < $tempovalue; $nbfichier++){
            $bloc .= file_get_contents($rootpassif.$objet[$defaultpage]['blocs'][$nbfichier].$pageextension,TRUE);
        }
        // ----------------- A SECURISER DE FOU ! -----------------
        require_once('ink/funky_visitor.php');
        VISITOR();
        $bloc .= preg_replace("_VISITOR_", $_SESSION['TICKET'], file_get_contents($rootactif.'visitor.php', TRUE));
        $bloc .= file_get_contents($rootpassif.'footer.php',TRUE);
        // ---------------------- META CAGOULE --------------------
        $bloc .= Gen_META($objet,'end_js',"in","section",$Origine+2).$n;                    // on met les js (bientot traité par le json)
        $bloc .= Spacer($Origine,2).'</div>'.$n;                                            // on ferme le div du début <div class="fullpage">
        $bloc .= Gen_META($objet,'end_js',"out","section",$Origine+1).$n;                   
        $bloc .= Spacer($Origine,1).'</body>'.$n;
        $bloc .= '</html>'.$n;
		return $bloc;
    }
    // -----------------------------------------------------------------------------------------------------------------------
    function Gen_META($objet,$koi,$choix,$balise,$Origine=0){
        // fonction pour la création des metas : title, script, stylesheet
        $n=PHP_EOL;
        $phrase = "";
		for ($i=0;$i<count($objet[$koi][$choix]);$i++){
            $html = "\n";
            $tag = "";$type="";$contentype="";$item="";$contentitem="";

            if (isset($objet[$koi][$choix][$i]['tag'])){          $tag =          $objet[$koi][$choix][$i]['tag'];}
            if (isset($objet[$koi][$choix][$i]['type']))          $type =         $objet[$koi][$choix][$i]['type'];
            if (isset($objet[$koi][$choix][$i]['contentype']))    $contentype =   $objet[$koi][$choix][$i]['contentype'];
            if (isset($objet[$koi][$choix][$i]['item']))          $item =         $objet[$koi][$choix][$i]['item'];
            if (isset($objet[$koi][$choix][$i]['contentitem']))   $contentitem =  $objet[$koi][$choix][$i]['contentitem'];

            $ValidationMeta = false;

            switch ($tag){
                case 'meta':
                    if ($contentype!="") $html ="".$tag." ".$type."=\"".$contentype."\"";
                    if ($item!="") $html .=" ".$tag." ".$item."=\"".$contentitem."\"";
                    $ValidationMeta = true;
                break;
                case 'link':
                    if ($contentype!="") $html ="".$tag." ".$type."=\"".$contentype."\"";
                    if ($item!="") $html .=" ".$tag." ".$item."=\"".$contentitem."\"";
                    $ValidationMeta = true;
                break;
                case 'title':
                    if ($contentype!="") $html =$tag.">".$contentype."</".$tag;
                    $ValidationMeta = true;
                break;
                case 'script':
                    if ($contentype!="") $html =$tag." ".$type."=\"".$contentype."\"></".$tag;
                    $ValidationMeta = true;
                break;
            }
            if ($ValidationMeta) $phrase .= Spacer($Origine,2)."<".$html.">".$n;
        }
        if ($phrase!="") $phrase =Spacer($Origine,1)."<".$balise.">".$n.$phrase.Spacer($Origine,1)."</".$balise.">";

        // test des ccs et js en plus pour la page appelée
        



		return $phrase;
    }
    // -----------------------------------------------------------------------------------------------------------------------
    function Spacer($Origine,$nb=1){
        $space="   ";
        $nb += $Origine;
        for ($i=1; $i<$nb; $i++){
            $space .= $space;
        }
        return $space;
    }
    // -----------------------------------------------------------------------------------------------------------------------
    function Check_empty($objet){
        $checked = "";
        if (isset($objet) && $objet!=""){
            $checked =$objet;
        }
        return $checked;
    }
    // -----------------------------------------------------------------------------------------------------------------------
    function EnzoMioPalmi($string){
        echo $string;
    }
    // THIS IS THE EEEEEENNNNNNNNDDDDDDDDDDDDDDDDDDDDDDD ---------------------------------------------------------------------
?>