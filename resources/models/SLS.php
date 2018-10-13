<?php
class SLS{
    private $sport;
    private $league;
    private $season;

    public function setValue($sport_id,$league_id,$season_id){
        $this->sport = $sport_id;
        $this->league = $league_id;
        $this->season = $season_id;

    }

    public function get_sport(){ return $this->sport;}
    public function get_league(){return $this->league;}
    public function get_season(){return $this->season;}
}


?>