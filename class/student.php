<?php 
include "DB.php";
class Student{
	private $table = 'tbl_sample';
	private $name; 
	private $email;  
	private $address;
	
	public function setName($name){
		$this->name = $name;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function setAddress($address){
		$this->address = $address;
	}

	public function insert(){
		$sql = "INSERT INTO $this->table (name, email, address) VALUES (:name, :email, :address)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':address', $this->address);
		return $stmt->execute();

	}

	public function readAll(){
		$sql = "SELECT * FROM $this->table";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function readById($id){
		$sql = "SELECT * FROM $this->table where id= :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function update($id){
		$sql = "UPDATE  $this->table SET name=:name, email=:email,address=:address WHERE id=:id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':address', $this->address);
		return $stmt->execute();

	}
	public function delete($id){
		$sql = "DELETE FROM $this->table  WHERE id=:id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id);
		return $stmt->execute();

	}

	




}
?>