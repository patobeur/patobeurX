
<?php 
//-------- USER CLASS ---------------------------------------------------------
$aujourdhui = date("Y-m-d");
$opt_inscription=FALSE;
//-----------------------------------------------------------------
class USER{
	private $coneXion;
	public $DataTable1 = "touitter"; // ma table touitter
	//-----------------------------------------------------------------
	public function __construct(){
		$database = new Database();
		$db = $database->dbConnection();
		$this->coneXion = $db;
	}
	//-----------------------------------------------------------------
	public function runQuery($sql){
		$stmt = $this->coneXion->prepare($sql);
		return $stmt;
	}
	//-----------------------------------------------------------------
	public function lasdID(){
		$stmt = $this->coneXion->lastInsertId();
		return $stmt;
	}
	//-----------------------------------------------------------------
	public function redirect($url){
		header("Location: $url");
	}
	//-----------------------------------------------------------------
	public function logout(){
		//session_destroy();
		$_SESSION['userSession'] = false;
	}
	//-----------------------------------------------------------------
	public function html_liste_toutitties($dataz){
		$ListeDataCount = count($dataz);
		$liste_toutitties_div = '';
        if ($ListeDataCount>0) {
			// echo "ok toutties";
			
			$CHAMPS = ['id','name','likes','ip','ts','comments_count','message','validation','date'];
			// AFFICHAGE LISTE TOUITTIES 

			$liste_toutitties_rows = '';
            for ($i = 0; $i < $ListeDataCount; $i++){
				$liste_toutitties_items = "";
				for ($j = 0; $j < count($CHAMPS); $j++){
					$liste_toutitties_items .= '<span class="item_touitties'.$CHAMPS[$j].'">'.$dataz[$i][$CHAMPS[$j]].'</span>';
				}
            	$liste_toutitties_rows .= '<div class="row_touitties">'.$liste_toutitties_items.'</div>';
			}			
            $liste_toutitties_div = '<div id="lst_touitties" class="Touitties">'.$liste_toutitties_rows.'</div>';
		}
		return $liste_toutitties_div;
	}
	//-----------------------------------------------------------------
	public function ListeDesTouitties(){
		// INSERT INTO `touitter` (`id`, `name`, `likes`, `ip`, `ts`, `comments_count`, `message`)
		// VALUES (NULL, 'Patobeur', '0', '192.168.0.1', '2147483647', '0', 'Vivement qu\'on me lise !');
		// $tempo = htmlentities($mavariable);
		// id 	name 	likes 	ip 	ts 	comments_count 	message 	validation 	date 
		try {
			$stmt = $this->coneXion->prepare('SELECT * FROM touitter');// WHERE message != "" ORDER BY name, id DESC');
			$stmt->execute();
			$rows = $stmt->fetchALL();
			return $this->html_liste_toutitties($rows);
		}
		catch(PDOException $ex){
			echo $ex->getMessage();
		}
	}
	//-----------------------------------------------------------------
	//-----------------------------------------------------------------
	// dans listequand.php
	public function listeTouittiesParName($orderN,$qui="vide"){
		if ($qui != "vide"){
			$order = "SELECT * FROM ".$DataTable1." WHERE name = '".$qui."'";
			$order .= " ORDER BY id DESC";
			try {
				$stmt = $this->coneXion->prepare($order);
				$stmt->execute();
				$rows = $stmt->fetchALL();
				return $rows;
			}
			catch(PDOException $ex){
				echo $ex->getMessage();
			}
		}
	}
	//-----------------------------------------------------------------
	public function cleanvar($mavariable,$typedevarriable){
		$tempo = $mavariable;

		switch ($typedevarriable) {
			case "espace":
				$tempo =  htmlentities(trim($tempo," "), ENT_QUOTES | ENT_IGNORE, "UTF-8");
				break;
			case "entier":
				$tempo =  intval($tempo);
				break;
			case "texte":
				$tempo = htmlentities(strip_tags($tempo), ENT_QUOTES | ENT_IGNORE, "UTF-8");
				break;
			case "passe":
				$tempo =  htmlentities(strip_tags($tempo), ENT_QUOTES , "UTF-8");
				break;
			case "mail":
				$tempo =  htmlentities($tempo);
				break;
		}
		return $tempo;
	}

	

	
	//-----------------------------------------------------------------
	public function isgood($mavariable,$type){
		// $tempo = htmlentities($mavariable);
		$reponse = False;
		switch ($type) {
			case "plusgrandque":
				if (strlen($mavariable)>6){
					$reponse = True;
				}
				break;
			case "entier":
				if (is_integer($mavariable)){
					$reponse = True;
				}
				break;
			case "mail":
				if (filter_var($mavariable, FILTER_VALIDATE_EMAIL)){
					$reponse = True;
				}
				break;
		}
		return $reponse;
	}
}
?>