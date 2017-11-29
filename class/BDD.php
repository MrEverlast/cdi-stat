<?php 
class BDD { 
	private $db;
	private $user;
	private $pwd;
	private $bdd;

	function __construct($new_db) {
		$this->db = $new_db;
		$this->user = 'root';
		$this->pwd = '';
		
		$this->bdd = new PDO('mysql:host=localhost;dbname='.$this->db, $this->user, $this->pwd);
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