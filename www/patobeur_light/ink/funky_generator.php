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
	function Ok_DOM($JSON_ORIG,$JSON_ARR,$koi,$choix,$Origine){
        $CURR_PAGE = OkCurr_Page($JSON_ARR['pages'],$JSON_ARR['defaultpage'][0]);
        $bloc = OkGen_Head($JSON_ARR,$CURR_PAGE,0);
        $bloc .= Gen_BODY($CURR_PAGE,$JSON_ARR,$koi,$choix,0);
        return $bloc;
    }
    // -----------------------------------------------------------------------------------------------------------------------
	function OkGen_Head($JSON_ARR,$CURR_PAGE,$Origine){
        $n=PHP_EOL;$message="";
        $message .= OkGen_Full_Bloc($JSON_ARR,'head',"meta","head",0,$CURR_PAGE);
        $message .= Gen_Head_Blocs($JSON_ARR,'atouslescoups','css',1);
        $message .= Gen_Head_Blocs($JSON_ARR,$CURR_PAGE,'css',1);
        $message = OkSpacer($Origine,1).'<head>'.$message.$n.OkSpacer($Origine,1).'</head>';
        $message = OkSpacer($Origine,1)."<!-- ". $CURR_PAGE ." -->".$n.OkSpacer($Origine,1).$message.$n.OkSpacer($Origine,1)."<!-- End's  ". $CURR_PAGE ." -->".$n;
        if (isset($JSON_ARR['structure']['meta']['lang'])){    $message =  $JSON_ARR['structure']['meta']['lang'].$n.$message;}
        if (isset($JSON_ARR['structure']['meta']['doctype'])){ $message =  $JSON_ARR['structure']['meta']['doctype'].$n.$message;}
        return $message;
    }
    // -----------------------------------------------------------------------------------------------------------------------
	function Gen_Pre_footer($JSON_ARR,$CURR_PAGE,$Origine){
        $n=PHP_EOL;$message="";
        $message .= OkGen_Full_Bloc($JSON_ARR,'head',"meta","head",0,$CURR_PAGE);
        return $message;
    }

    // -----------------------------------------------------------------------------------------------------------------------
	function Gen_Head_Blocs($ARRRRAIE,$famille,$nomchamp,$Origine=0){
        $n=PHP_EOL;$message = '';
        $ARRRRAIE = $ARRRRAIE[$famille];
            $tempovalueout = count($ARRRRAIE[$nomchamp]);
            if ($tempovalueout > 0 ){
                for ($nb_item = 0; $nb_item < $tempovalueout; $nb_item++){
                    $message .= OkSpacer($Origine,1).'<link rel="stylesheet" href="'.$ARRRRAIE[$nomchamp][$nb_item].'">'.$n;
                }
            }
        $message = OkSpacer($Origine,1)."<!-- ".$famille." ".$nomchamp." -->".$n.$message.OkSpacer($Origine,1)."<!-- ".$famille." ".$nomchamp." -->".$n;
		return $message;
    }
    // -----------------------------------------------------------------------------------------------------------------------
	function OkGen_JS($ARRRRAIE,$famille,$nomchamp,$Origine=0){
        $n=PHP_EOL;$message = '';
        $ARRRRAIE = $ARRRRAIE[$famille];
            $tempovalueout = count($ARRRRAIE[$nomchamp]);
            if ($tempovalueout > 0 ){
                for ($nb_item = 0; $nb_item < $tempovalueout; $nb_item++){
                    $message .= OkSpacer($Origine,1).'<script src="'.$ARRRRAIE[$nomchamp][$nb_item].'" type="text/javascript"></script>'.$n;
                }
            }
        $message = OkSpacer($Origine,1)."<!-- Début ".$famille." ".$nomchamp." -->".$n.$message.OkSpacer($Origine,1)."<!-- Fin ".$famille." ".$nomchamp." -->".$n;
		return $message;
    }
    // -----------------------------------------------------------------------------------------------------------------------
    function OkGen_Full_Bloc($JSON_ARR,$koi,$choix,$balise,$Origine=0,$CURR_PAGE=''){
        // fonction pour la création des metas : title, script, stylesheet
        $n=PHP_EOL;
        $phrase = $n.OkSpacer($Origine,2)."<!-- ". $koi ."/" . $choix . " -->".$n;
       
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
                case 'src':
                    if ($contentype!="") $html = $tag." ".$typeof."=\"".$contentype."\"";
                    if ($contentype!="" && $item!="") $html .= " ".$item."=\"".$contentitem."\"";
                    if ($contentype!="") $html .= "></".$tag;
                    $ValidationMeta = true;
                break;
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
                    if ($type!="") $html .= " ".$type."=\"".$typeitem."\"";
                    $ValidationMeta = true;
                break;
            }
            if ($ValidationMeta) $phrase .= OkSpacer($Origine,2)."<".$html.">".$n;
        }
        $phrase .= OkSpacer($Origine,2).'<!-- End\'s '. $koi .'/' . $choix . ' -->'.$n;
        if ($phrase!="") $phrase = $n.$phrase.$n;
		return $phrase;
    }
    // -----------------------------------------------------------------------------------------------------------------------
    
    function OkCurr_Page($lespages,$pagepardefaut){
        $CURR_PAGE = $pagepardefaut;   // page par default
        $Posted = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        
        // un pti coup de sécu ici        
        for ($i=0; $i < count($lespages); $i++){              // on prend la liste des page existante dans le json
            if (preg_match("'".$lespages[$i]."'",$Posted)){   // la page est elle dans l'url ??
                $CURR_PAGE = $lespages[$i];                         // si oui on prend le nom dans $what 
                // break;                                              // on stop ou pas pour chopper la dernier
            }
        }
        $_SESSION['CURR_PAGE'] = $CURR_PAGE;
        return $CURR_PAGE;
    }



    // -----------------------------------------------------------------------------------------------------------------------
    // Point G.culture
    // un post sympa sur le json et le javascript
    // https: //openclassrooms.com/forum/sujet/jquery-utiliser-un-json-cree-avec-php
	// -----------------------------------------------------------------------------------------------------------------------
    function Gen_BODY($CURR_PAGE,$JSON_ARR,$koi,$choix,$Origine=0){
        $n=PHP_EOL;$bloc="\n";
        $bloc .= OkSpacer($Origine,1).'<body>'.$n;
        $bloc .= OkSpacer($Origine,2).'<div class="fullpage">'.$n;
        // -------------------------------------- 
        $rootpassif =  'in/_in_';
        $pageextension = ".php";            // utiles pour le file_get_contents plus bas
        // -------------------------------------- 


        
        // ici nbavigation
        require_once('funky_navigation.php');
        $bloc .= Navigat($JSON_ARR,'pages');



        // generation des pages a integrer dans le body en dessous de navigation mais en dessus du footer
        // ici je cherche $CURR_PAGE dans le json
        // je prend la liste des pages _in_ a intégrer
        $tempovalue = count($JSON_ARR[$CURR_PAGE]['blocs']);
        for ($nbfichier = 0; $nbfichier < $tempovalue; $nbfichier++){
            $bloc .= file_get_contents($rootpassif.$JSON_ARR[$CURR_PAGE]['blocs'][$nbfichier].$pageextension,TRUE).$n;
        }


        // en fin de page
        // ouvrir les pages a include a coup sur genre visitor


        $bloc .= GetPageParLots($JSON_ARR['aouvriratouslescoups'],'files').$n;

        

        // $bloc .= GetPageParLots($JSON_ARR['actif']);
        // FOOTER
        $bloc .= file_get_contents($rootpassif.'footer.php',TRUE).$n;
        //
        $bloc .= OkGen_JS($JSON_ARR,$CURR_PAGE,'js',2);
        $bloc .= OkSpacer($Origine,2).'</div>'.$n;    // on ferme le div du début <div class="fullpage">
        $bloc .= OkGen_JS($JSON_ARR,'atouslescoups','js',1);

        $bloc .= OkSpacer($Origine,1).'</body>'.$n;   // on ferme le body
        $bloc .= '</html>'.$n;
		return $bloc;
    }
    // -----------------------------------------------------------------------------------------------------------------------



    function GetPageParLots($ARRRRAIE, $CHILDy){
        $n=PHP_EOL;
        $rootactif2 =  'in/_in_';
        
        // if ($ARRRRAIE['actif']){
            $tempovalueout = count($ARRRRAIE[$CHILDy]);
            if ($tempovalueout > 0 ){
                for ($nbfichierout = 0; $nbfichierout < $tempovalueout; $nbfichierout++){

                    if ($ARRRRAIE[$CHILDy][$nbfichierout]['page']!="") $ext_file = "ink/funky_".$ARRRRAIE[$CHILDy][$nbfichierout]['page'].".php"; // file to include
                    if ($ARRRRAIE[$CHILDy][$nbfichierout]['page']!="") $ink_file = $rootactif2.$ARRRRAIE[$CHILDy][$nbfichierout]['page'].".php"; // file to get_contents
                    if ($ARRRRAIE[$CHILDy][$nbfichierout]['aremplacer']!="") $aremplacer = $ARRRRAIE[$CHILDy][$nbfichierout]['aremplacer'];
                    if ($ARRRRAIE[$CHILDy][$nbfichierout]['session']!="") $lasesssion = $ARRRRAIE[$CHILDy][$nbfichierout]['session'];
                    if ($ARRRRAIE[$CHILDy][$nbfichierout]['require']!="") $require = $ARRRRAIE[$CHILDy][$nbfichierout]['require'];
                    if ($ARRRRAIE[$CHILDy][$nbfichierout]['visible']!="") $visible = $ARRRRAIE[$CHILDy][$nbfichierout]['visible'];
                    // ------------------- DANGER ! ----------------------------------
                    // ici aussi je compte sur le fait que le json est planqué sous www)
                    if ($require) require_once($ext_file); // on appel le fichier demander dans le json (ça craint !!! mais ??? )
                    if ($visible) return preg_replace($aremplacer, $valeurderetour, file_get_contents($ink_file, TRUE)).$n; // re ça craint )
                    // $bloc .= file_get_contents($rootpassif.$ARRRRAIE['blocs'][$nbfichierout].$pageextension,TRUE).$n;
                }
            }
        // }
    }


    // -----------------------------------------------------------------------------------------------------------------------
    function Gen_Full_Blocs($JSON_ARR,$koi,$choix,$balise,$Origine=0,$CURR_PAGE=''){
        // fonction pour la création des metas : title, script, stylesheet
        $n=PHP_EOL;
        $phrase = $n.OkSpacer($Origine,2)."<!-- ". $koi ."/" . $choix . " -->".$n;
       
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
                case 'src':
                    if ($contentype!="") $html = $tag." ".$typeof."=\"".$contentype."\"";
                    if ($contentype!="" && $item!="") $html .= " ".$item."=\"".$contentitem."\"";
                    if ($contentype!="") $html .= "></".$tag;
                    $ValidationMeta = true;
                break;
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
                    if ($type!="") $html .= " ".$type."=\"".$typeitem."\"";
                    $ValidationMeta = true;
                break;
            }
            if ($ValidationMeta) $phrase .= OkSpacer($Origine,2)."<".$html.">".$n;
        }
        $phrase .= OkSpacer($Origine,2).'<!-- End\'s '. $koi .'/' . $choix . ' -->'.$n;





        // GENERATION CSS TROUVE DANS LE JSON
        if ($koi=="head" && count($JSON_ARR[$CURR_PAGE]['css'])>0) {
            $phrase .= OkSpacer($Origine,2).'<!-- '. $koi .'/' . $choix . ' -->'.$n;
            for ($j=0;$j<count($JSON_ARR[$CURR_PAGE]['css']);$j++){
                if ($JSON_ARR[$CURR_PAGE]['css'][$j]!="") {
                    $phrase .= OkSpacer($Origine,2).'<link rel="stylesheet" href="'.$JSON_ARR[$CURR_PAGE]['css'][$j].'">'.$n;
                }
            }
            $phrase .= OkSpacer($Origine,2).'<!-- End\'s '. $koi .'/' . $choix . ' -->'.$n;
        }



        // fin css
        if ($phrase!="") $phrase =OkSpacer($Origine,1)."<".$balise.">".$n.$phrase.OkSpacer($Origine,1)."</".$balise.">";

		return $phrase;
    }
    // -----------------------------------------------------------------------------------------------------------------------
    function OkSpacer($Origine,$nb=1){
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