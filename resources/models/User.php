<?php

class User implements Model{

    private $username;
    private $role;
    private $password;
    private $team;
    private $league;

    public function __construct(){

    }

    public function setValues($username,$password,$role,$team,$league){
        $this->username     = $username;
        $this->password     = password_hash($password,PASSWORD_DEFAULT);
        $this->role         = $role;
        $this->team         = $team;
        $this->league       = $league;
    }

    /**
     * Method that converts the object into key-value array used to create prepared statements and bind their values
     */
    public function db_config(){
        $config = array();
        $config['class'] = 'User';
        $config['table_name'] = 'server_user';

        $keys = [
            'username','role','password','team','league'
        ];

        $values = [
            $this->username,$this->role,$this->password,$this->team,$this->league
        ];

        $config['values']   = $values;
        $config['keys']     = $keys;

        return $config;
    }


    
}