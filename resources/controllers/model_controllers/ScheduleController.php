<?php
class ScheduleController{
    private $db;

    public function __construct(){
        $this->db = new DatabaseController();
    }

    public function add_schedule($new_schedule){
        $params     = $new_schedule->db_config();
        $keys       = $params['keys'];
        $values     = $params['values'];
    
        $query = 'INSERT INTO '.$params['table_name'].'('.DatabaseHelpers::getKeyString($keys).') VALUES ('.DatabaseHelpers::getParameterPlaceholders($values).');';

        if($this->db->alter($query,$values)) return true;
        else return false; 
    }

    public function get_all_schedules(){
        $query = "SELECT * FROM server_schedule";

        return $this->db->select_object($query,[],"Schedule");
    }

    /**
     * Key is the damned db_config['values']
     */
    public function get_schedules_by_key($key){
        $query =    "SELECT * FROM server_schedule WHERE"+
                    "sport = ? AND league = ? AND season = ? and hometeam = ? ".
                    "AND awayteam = ? AND homescore = ? and awayscore = ? ".
                    "AND scheduled = ? AND completed = ?";
        
        return $this->db->select_object($query,$key,"Schedule")[0];
    }

    public function get_schedules_by_league($league_id){
        $query = "SELECT * FROM server_schedule WHERE league = ?";

        return $this->db->select_object($query,[$league_id],"Schedule");
    }

    public function get_schedules_by_home_team($home_id){
        $query = "SELECT * FROM server_schedule WHERE hometeam = ?";

        return $this->db->select_object($query,[$home_id],"Schedule");
    }

    public function delete_schedule($key){
        $query =    "DELETE FROM server_schedule WHERE ".
                    "sport = ? AND league = ? AND season = ? and hometeam = ? ".
                    "AND awayteam = ? AND homescore = ? and awayscore = ? ".
                    "AND scheduled = ? AND completed = ?";
        return $this->db->alter($query,$key);
    }

    public function cascade_sport($sport_id){
        $query = "DELETE FROM server_schedule WHERE sport = ?";

        return $this->db->alter($query,[$sport_id]);

    }

    public function cascade_league($league_id){
        $query = "DELETE FROM server_schedule WHERE league = ?";

        return $this->db->alter($query,[$league_id]);
    }

    public function cascade_team($team_id){
        $query = "DELETE FROM server_schedule WHERE hometeam = ? OR awayteam = ?";

        return $this->db->alter($query,[$team_id,$team_id]);
    }

    public function cascade_sls($sport, $league, $season){
        $query = "DELETE FROM server_schedule WHERE sport = ? AND league = ? AND season = ?";

        return $this->db->alter($query,[$sport, $league, $season]);
    }


}
?>