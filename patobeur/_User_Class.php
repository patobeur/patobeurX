
<?php 

$aujourdhui = date("Y-m-d");
$opt_inscription=FALSE;

class USER{
	private $coneXion;
	public $DataTable1 = "touitter"; // ma table touitter

	public function __construct(){
		$database = new Database();
		$db = $database->dbConnection();
		$this->coneXion = $db;
	}

	public function runQuery($sql){
		$stmt = $this->coneXion->prepare($sql);
		return $stmt;
	}

	public function lasdID(){
		$stmt = $this->coneXion->lastInsertId();
		return $stmt;
	}

	public function redirect($url){
		header("Location: $url");
	}

	public function logout(){
		session_destroy();
		$_SESSION['userSession'] = false;
	}


	public function ListeDesTouitties(){
		try {
			$stmt = $this->coneXion->prepare("SELECT * FROM ".$DataTable1." WHERE message != "" ORDER BY name, id DESC");
			$stmt->execute();
			$rows = $stmt->fetchALL();
			return $rows;
		}
		catch(PDOException $ex){
			echo $ex->getMessage();
		}
	}

	// dans listequand.php
	public function listeTouittiesDuName($orderN,$qui="vide"){
		$order = "";
		if ($qui == "vide"){
			$order = "SELECT * FROM ".$DataTable1." WHERE name != ''";
		}else{
			$order = "SELECT * FROM ".$DataTable1." WHERE name = '".$qui."'";
		}
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