<?php 

namespace App\Core\Model;

/**
 * Exemple ! 
 */
class User{

	private $_id;
	private $_username;
	private $_password;

	public function __construct($id, $username, $password){
		$this->_id = $id;
		$this->_username = $username;
		$this->_password = $password;
	}

	public function getId(){
		return $this->_id;
	}

	public function setId($id){
		$this->_id = $id;
	}

	public function getUsername(){
		return $this->_username;
	}

	public function setUsername($username){
		$this->_username = $username;
	}

	public function getPassword(){
		return $this->_password;
	}

	public function setPassword($password){
		$this->_password = $password;
	}

}