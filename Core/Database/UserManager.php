<?php 

namespace App\Core\Database;

use App\Core\Model\User;

/**
 * Exemple ! Manage the database connection with 'user' table
 */
class UserManager extends DbManager{
    
    public function getAll(){ 
        $return = []; 
        $request = $this->db->prepare("SELECT * FROM user"); 
        $request->execute(); 
        $result = $request->fetchAll(); 
        foreach($result as $array){ 
            $return[] = new User($array['id'], $array['username'], $array['password']); 
        } 
        return $return; 
    }

    public function getById($id){
        $request = $this->db->prepare("SELECT * FROM user WHERE id = :id");
        $request->execute(["id" => $id]);
        $array = $request->fetch();
        if($array) return new User($array['id'], $array['username'], $array['password']);
        else return false;
    }

    public function getBy($field, $value){
        $request = $this->db->prepare("SELECT * FROM user WHERE ".$field." = :val");
        $request->execute(["val" => $value]);
        $array = $request->fetch();
        if($array) return new User($array['id'], $array['username'], $array['password']);
        else return false;
    }
    
    public function create(User $oUser){ 
        $request = $this->db->prepare("INSERT INTO user (`id`, `username`, `password`) VALUES (:val0, :val1, :val2)"); 
        $request->execute(["val0"=> $oUser->getId(), "val1"=> $oUser->getUsername(), "val2"=> $oUser->getPassword()]); 
        return $this->db->lastInsertId(); 
    }  

    public function edit(User $oUser){  
        $request = $this->db->prepare("UPDATE user SET username=:val1, password=:val2 WHERE id=:val0"); 
        $request->execute(["val0"=> $oUser->getId(), "val1"=> $oUser->getUsername(), "val2"=> $oUser->getPassword()]); 
    }

    public function delete($id){
        $this->db->prepare("DELETE FROM user WHERE id=?")->execute([$id]);
    }

}