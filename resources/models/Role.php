<?php
class Role{
    private $id;
    private $name;

    public function __construct(){}

    public function get_role_name(){
        return $this->name;
    }
}