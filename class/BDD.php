<?php 
class BDD { 
	private $ip;
	private $dbName;
	private $user;
	private $password;
	private $bdd;
	private $port;

	function __construct($ip,$dbName,$user,$password,$port) {
		$this->ip = $ip;
		$this->dbName = $dbName;
		$this->user = $user;
		$this->password = $password;
		$this->port = $port;
		
		$url = 'mysql:host='.$this->ip.';dbname='.$this->dbName;

		$this->bdd = new PDO($url, $this->user, $this->password);
		$this->bdd->exec('SET NAMES utf8');
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