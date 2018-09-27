<?php
class League{
    private $id;
    private $name;

    public function __construct(){

    }

    public function setValues($name){
        $this->name = $name;
    }

    public function db_config(){
        $config = array();
        $config['class'] = 'League';
        $config['table_name'] = 'server_league';

        $keys = ['name'];
        $values = [$this->name];
        
        $config['values']   = $values;
        $config['keys']     = $keys;

        return $config;
    }

    public function get_id(){
        return $this->id;
    }

    public function get_name(){
        return $this->name;
    }


}


?>