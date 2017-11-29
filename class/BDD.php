<?php 
class BDD { 
	private $url;
	private $dbName;
	private $user;
	private $password;
	private $bdd;

	function __construct($url,$dbName,$user,$password) {
		$this->url = $url;
		$this->dbName = $dbName;
		$this->user = $user;
		$this->password = $password;
		
		$this->bdd = new PDO('mysql:host='.$this->url.';dbname='.$this->dbName, $this->user, $this->password);
	}
	
	function requeteBDD($requete){
		try {
			$prep = $this->bdd->prepare($requete);
			$prep->execute();
			return $prep;
		} catch (PDOException $e) {
			return "Error!: " . $e->getMessage() . "<br/>";
		}
	}
}
?>