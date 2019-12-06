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
    
	function Gen_DOM($JSON_ORIG,$JSON_ARR,$koi,$choix){
    // appelé dans index 
    // EnzoMioPalmi(Gen_DOM($Bloc_HTML_json_arr,$Structure_json_arr,'structure',"meta","    "));
        
        $Posted = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        // ----------------- A SECURISER DE FOU ! -----------------
        $defaultpage = $JSON_ARR['defaultpage'][0];   // page par default
        $pagesacceptees = $JSON_ARR['pages'];   // les pages sont dans le json a la section pages et en dessous
        // -------------------- ici un peu le bordel mais je tricotte là ------------------------------------
        for ($i=0; $i < count($JSON_ARR['pages']); $i++){              // on prend la liste des page existante dans le json
            if (preg_match("'".$JSON_ARR['pages'][$i]."'",$Posted)){   // la page est elle dans l'url ??
                $defaultpage = $pagesacceptees[$i];                         // si oui on prend le nom dans $what 
                // break;                                              // on stop ou pas 
            }
        }
        
        $bloc="";
        $bloc .= Gen_Page_Top($JSON_ARR,$koi,$choix,0,$defaultpage);
        $bloc .= Gen_BODY($defaultpage,$JSON_ORIG,$JSON_ARR,$koi,$choix,0);
        return $bloc;
    }
    // -----------------------------------------------------------------------------------------------------------------------
	function Gen_Page_Top($JSON_ARR,$koi,$choix,$Origine,$defaultpage){
        $n=PHP_EOL;$bloc="";
        if (isset($JSON_ARR[$koi][$choix]['doctype'])){              $bloc .=        $JSON_ARR[$koi][$choix]['doctype'].$n;}
        if (isset($JSON_ARR[$koi][$choix]['lang'])){                 $bloc .=        $JSON_ARR[$koi][$choix]['lang'].$n;}

        $bloc .= Gen_META($JSON_ARR,'head',"meta","head",$Origine,$defaultpage);
        // $bloc .= Gen_META($JSON_ARR,$defaultpage,"css","head",$Origine,'css');

		return $bloc;
    }
    // -----------------------------------------------------------------------------------------------------------------------
    
    // -----------------------------------------------------------------------------------------------------------------------
    // Point G.culture
    // un post sympa sur le json et le javascript
    // https: //openclassrooms.com/forum/sujet/jquery-utiliser-un-json-cree-avec-php
	// -----------------------------------------------------------------------------------------------------------------------
    function Gen_BODY($defaultpage,$JSON_ORIG,$JSON_ARR,$koi,$choix,$Origine=0){
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
        $tempovalue = count($JSON_ARR[$defaultpage]['blocs']);
        for ($nbfichier = 0; $nbfichier < $tempovalue; $nbfichier++){
            $bloc .= file_get_contents($rootpassif.$JSON_ARR[$defaultpage]['blocs'][$nbfichier].$pageextension,TRUE);
        }
        // ----------------- A SECURISER DE FOU ! -----------------
        require_once('ink/funky_visitor.php');
        VISITOR();
        $bloc .= preg_replace("_VISITOR_", $_SESSION['TICKET'], file_get_contents($rootactif.'visitor.php', TRUE));
        $bloc .= file_get_contents($rootpassif.'footer.php',TRUE);
        // ---------------------- META CAGOULE --------------------
        $bloc .= Gen_META($JSON_ARR,'end_js',"in","section",$Origine+2).$n;                    // on met les js (bientot traité par le json)
        $bloc .= Spacer($Origine,2).'</div>'.$n;                                            // on ferme le div du début <div class="fullpage">
        $bloc .= Gen_META($JSON_ARR,'end_js',"out","section",$Origine+1).$n;
        //
        //
        // GENERATION JS SCRIPT TROUVE DANS LE JSON
        $bloc .= Spacer($Origine,2)."<!-- Auto JS -->".$n;
        for ($j=0;$j<count($JSON_ARR[$defaultpage]['js']);$j++){
            //echo "ok ".$j;
            if ($JSON_ARR[$defaultpage]['js'][$j]!="") {
                $bloc .= Spacer($Origine,2).'<script src="'.$JSON_ARR[$defaultpage]['js'][$j].'" type="text/javascript"></script>'.$n;
            }
        }
        $bloc .= Spacer($Origine,2)."<!-- End's Auto JS -->".$n;
        //
        //
            

        //
        $bloc .= Spacer($Origine,1).'</body>'.$n;                                           // on ferme le body
        $bloc .= '</html>'.$n;
		return $bloc;
    }
    // -----------------------------------------------------------------------------------------------------------------------
    function Gen_Curr_META($JSON_ARR,$pagename){

    }
    // -----------------------------------------------------------------------------------------------------------------------
    function Gen_META($JSON_ARR,$koi,$choix,$balise,$Origine=0,$defaultpage=''){
        // fonction pour la création des metas : title, script, stylesheet
        $n=PHP_EOL;
        $phrase = "";
		for ($i=0;$i<count($JSON_ARR[$koi][$choix]);$i++){
            $html = "\n";
            $tag = "";$type="";$contentype="";$item="";$contentitem="";
            // -------------- 
            if (isset($JSON_ARR[$koi][$choix][$i]['typeof'])){          $typeof =          $JSON_ARR[$koi][$choix][$i]['typeof'];}
            if (isset($JSON_ARR[$koi][$choix][$i]['nameof'])){          $nameof =          $JSON_ARR[$koi][$choix][$i]['nameof'];}
            // --------------
            if (isset($JSON_ARR[$koi][$choix][$i]['tag'])){            $tag =              $JSON_ARR[$koi][$choix][$i]['tag'];}
            if (isset($JSON_ARR[$koi][$choix][$i]['type']))            $type =             $JSON_ARR[$koi][$choix][$i]['type'];
            if (isset($JSON_ARR[$koi][$choix][$i]['contentype']))      $contentype =       $JSON_ARR[$koi][$choix][$i]['contentype'];
            if (isset($JSON_ARR[$koi][$choix][$i]['item']))            $item =             $JSON_ARR[$koi][$choix][$i]['item'];
            if (isset($JSON_ARR[$koi][$choix][$i]['contentitem']))     $contentitem =      $JSON_ARR[$koi][$choix][$i]['contentitem'];
            if (isset($JSON_ARR[$koi][$choix][$i]['typeitem']))        $typeitem =         $JSON_ARR[$koi][$choix][$i]['typeitem'];

            $ValidationMeta = false;

            switch ($typeof){
                case 'charset':
                    if ($contentype!="") $html = $tag." ".$typeof."=\"".$contentype."\"/";
                    $ValidationMeta = true;
                break;
                case 'title':
                    if ($contentype!="") $html = $tag.">".$contentype."</".$tag;
                    $ValidationMeta = true;
                break;
                case 'name':
                    if ($contentype!="") $html = $tag." ".$typeof."=\"".$contentype."\"";
                    if ($item!="") $html .= " ".$item."=\"".$contentitem."\"";
                    $ValidationMeta = true;
                break;
                case 'http-equiv':
                    if ($contentype!="") $html = $tag." ".$typeof."=\"".$contentype."\"";
                    if ($item!="") $html .= " ".$item."=\"".$contentitem."\"";
                    $ValidationMeta = true;
                break;
                case 'rel':
                    if ($contentype!="") $html = $tag." ".$typeof."=\"".$contentype."\"";
                    if ($item!="") $html .= " ".$item."=\"".$contentitem."\"";
                    $ValidationMeta = true;
                break;
                case 'favicon':
                    if ($contentype!="") $html = $tag." ".$typeof."=\"".$contentype."\"";
                    if ($item!="") $html .= " ".$item."=\"".$contentitem."\"";
                    if ($type!="") $html .= " ".$type."=\"".$typeitem."\" /";
                    $ValidationMeta = true;
                break;
            }
            if ($ValidationMeta) $phrase .= Spacer($Origine,2)."<".$html.">".$n;

        }

        // GENERATION CSS TROUVE DANS LE JSON
        if ($koi=="head" && count($JSON_ARR[$defaultpage]['css'])>0) {
            //echo "ok";
            for ($j=0;$j<count($JSON_ARR[$defaultpage]['css']);$j++){
                //echo "ok ".$j;
                if ($JSON_ARR[$defaultpage]['css'][$j]!="") {
                    // echo "[ok".$typeof."]";
                    $phrase .= Spacer($Origine,2).'<link rel="stylesheet" href="'.$JSON_ARR[$defaultpage]['css'][$j].'">'.$n;
                }
            }
        }
        // fin css

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
    function Check_empty($JSON_ARR){
        $checked = "";
        if (isset($JSON_ARR) && $JSON_ARR!=""){
            $checked = $JSON_ARR;
        }
        return $checked;
    }
    // -----------------------------------------------------------------------------------------------------------------------
    function EnzoMioPalmi($string){
        echo $string;
    }
    // THIS IS THE EEEEEENNNNNNNNDDDDDDDDDDDDDDDDDDDDDDD ---------------------------------------------------------------------
?>