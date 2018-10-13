<?php
class SLSController{
    private $db;

    public function __construct(){
        $this->db = new DatabaseController();
    }

    public function add_sls($sls_obj){
        $query = "INSERT INTO server_slseason VALUES (?, ?, ?)";
        $params = [$sls_obj->get_sport(), $sls_obj->get_league(), $sls_obj->get_season()];

        return $this->db->alter($query,$params);
    }

    /**
     * Format of the key is ['sport'=>$sport, 'league'=>$league, 'season'=>$season]
     */
    public function get_sls_by_key($key){
        $query = "SELECT * FROM server_slseason SET sport = ? AND league = ? AND season = ?";
        $params = [$key['sport'],$key['league'],$key['season']];

        return $this->db->select_object($query,$params,"SLS");
    }

    public function get_all_sls(){
        $query = "SELECT * FROM server_slseason ";
        $params = [];

        return $this->db->select_object($query,$params,"SLS");
    }

    public function modify_sls($old_sls, $new_sls){
        $query = "UPDATE server_slseason SET sport = ? AND league = ? AND season = ? WHERE sport = ? AND league = ? and season = ?";
        $params = [
            $new_sls->get_sport(),
            $new_sls->get_league(),
            $new_sls->get_season(),
            $old_sls->get_sport(),
            $old_sls->get_league(),
            $old_sls->get_season()
        ];

        return $this->db->alter($query,$params);
    }

    

    public function delete_sls($sls_obj){
        $query = "DELETE FROM server_slseason WHERE sport = ? AND league = ? and season = ?";
        $params = [$sls_obj->get_sport(), $sls_obj->get_league(), $sls_obj->get_season()];

        return $this->db->alter($query,$params);
    }

    public function cascade_sport($sport_id){
        $query = "DELETE FROM server_slseason WHERE sport = ?";
        $params = [$sport_id];

        return $this->db->alter($query,$params);
    }

    public function cascade_season($season_id){
        $query = "DELETE FROM server_slseason WHERE season = ?";
        $params = [$season_id];

        return $this->db->alter($query,$params);
    }

    public function cascade_league($league_id){
        $query = "DELETE FROM server_slseason WHERE league = ?";
        $params = [$league_id];

        return $this->db->alter($query,$params);
    }


}


?>