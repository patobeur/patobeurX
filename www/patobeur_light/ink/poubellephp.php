
<?php

	function lesmenus2($objet){
		$n=PHP_EOL;
		$html .= "";
		for ($i=0;$i<count($objet);$i++){
			$html .= $objet[$i]['titre'].'<br />'.$n;		
			$html .= $objet[$i]['fichier'].'<br />'.$n;		
			$html .= $objet[$i]['image'].'<br />'.$n;
			$espace = "--";
			if (is_array($objet[$i]['pages'])){
				for ($j=0;$j<count($objet[$i]['pages']);$j++){
					$html .= $espace.$objet[$i]['pages'][$j]['titre'].'<br />'.$n;;
					$html .= $espace.$objet[$i]['pages'][$j]['fichier'].'<br />'.$n;;
					$html .= $espace.$objet[$i]['pages'][$j]['image'].'<br />'.$n;;
				}
			}
		}
		return $html;
	}
    ?>