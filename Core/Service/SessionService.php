<?php 

namespace App\Core\Service;

/**
 * Manage the session dynamically with magical methods
 */
class SessionService {

    private $data = [];

    public function __construct(){
        $this->data = $_SESSION;
    }

    public function __get($name){
        if(isset($this->data[$name])){
            return unserialize($this->data[$name]);
        }
    }

    public function __set($name, $value){
        if($value == '')
            unset($this->data[$name]);
        else
            $this->data[$name] = $value;
    }

    public function __isset($name) {
        return isset($this->data[$name]);
    }

    public function __unset($name) {
        unset($this->data[$name]);
    }

    public function __destruct(){
        $_SESSION = $this->data;
    }

    public function __toString() {
        return $this->data;
    }
}