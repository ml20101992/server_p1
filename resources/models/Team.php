<?php
class Team{
    private $id;
    private $name;
    private $mascot;
    private $sport;
    private $league;
    private $season;
    private $picture;
    private $homecolor;
    private $awaycolor;
    private $maxplayers;

    public function __construct(){

    }

    public function setValues($name,$mascot,$sport,$league,$season,$picture,$homecolor,$awaycolor,$maxplayers){
        $this->name         = $name;
        $this->mascot       = $mascot;
        $this->sport        = $sport;
        $this->league       = $league;
        $this->season       = $season;
        $this->picture      = $picture;
        $this->homecolor    = $homecolor;
        $this->awaycolor    = $awaycolor;
        $this->maxplayers   = $maxplayers;
    }

    public function db_config(){
        $config = array();
        $config['class'] = 'Team';
        $config['table_name'] = 'server_team';

        $keys = [
            "name","mascot","sport","league","season","picture","homecolor","awaycolor","maxplayers"
        ];

        $values = [
            $this->name,
            $this->mascot,
            $this->league,
            $this->season,
            $this->picture,
            $this->homecolor,
            $this->awaycolor,
            $this->maxplayers
        ];

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

    public function get_mascot(){
        return $this->mascot;
    }

    public function get_league(){
        return $this->league;
    }

    public function get_season(){
        return $this->season;
    }

    public function get_picture(){
        return $this->picture;
    }

    public function get_homecolor(){
        return $this->homecolor;
    }

    public function get_awaycolor(){
        return $this->awaycolor;
    }

    public function get_maxplayers(){
        return $this->maxplayers;
    }

}


?>