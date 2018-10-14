<?php
class Schedule{
    private $sport;
    private $league;
    private $season;
    private $hometeam;
    private $awayteam;
    private $homescore;
    private $awayscore;
    private $scheduled;
    private $completed;

    public function setValue($sport,$season,$league,$hometeam,$awayteam,$homescore,$awayscore,$scheduled,$completed){
        $this->sport = $sport;
        $this->league = $league;
        $this->season = $season;
        $this->hometeam = $hometeam;
        $this->awayteam = $awayteam;
        $this->homescore = $homescore;
        $this->awayscore = $awayscore;
        $this->scheduled = $scheduled;
        $this->completed = $completed;
    }

    public function get_sport(){return $this->sport;}
    public function get_league(){return $this->league;}
    public function get_season(){return $this->season;}
    public function get_hometeam(){return $this->hometeam;}
    public function get_awayteam(){return $this->awayteam;}
    public function get_homescore(){return $this->homescore;}
    public function get_awayscore(){return $this->awayscore;}
    public function get_scheduled(){return $this->scheduled;}
    public function get_completed(){return $this->completed;}

    public function db_config(){
        $config = array();
        $config['class'] = 'Schedule';
        $config['table_name'] = 'server_schedule';

        $keys = [
            'sport','league','season','hometeam','awayteam','homescore','awayscore','scheduled','completed'
        ];

        $values = [
            $this->sport,$this->league,$this->season,$this->hometeam,$this->awayteam,$this->homescore,$this->awayscore,$this->scheduled,$this->completed
        ];

        $config['values']   = $values;
        $config['keys']     = $keys;

        return $config;
    }
}

?>