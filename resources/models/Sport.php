<?php
class Sport{
    private $id;
    private $name;

    public function set_name($value){
        $this->name = $value;
    }

    public function get_name(){ return $this->name; }
    public function get_id(){ return $this->id; }
    
}


?>