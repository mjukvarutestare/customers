<?php
class Person{	
	private $conn;
	private $table_name = "person";
	public $id;
	public $firstname;
	public $lastname;
	public $occupation;
	
	public function __construct($db){
		$this->conn=$db;
	}
	
	// read products
	function read(){
		// select all query
		$query = "SELECT
					p.id, p.firstname, p.lastname, p.occupation
				FROM
					" . $this->table_name . " p";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
}