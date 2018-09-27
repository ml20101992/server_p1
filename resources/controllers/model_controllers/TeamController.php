<?php
class TeamController{
    private $db;

    public function __construct(){
        $this->db = new DatabaseController();
    }

    public function add_new_team($team){
        $params     = $team->db_config();
        $keys       = $params['keys'];
        $values     = $params['values'];
    
        $query = 'INSERT INTO '.$params['table_name'].'('.DatabaseHelpers::getKeyString($keys).') VALUES ('.DatabaseHelpers::getParameterPlaceholders($values).');';

        if($this->db->alter($query,$values)) return true;
        else return false; 
    }

    public function get_all_teams(){
        $query = 'SELECT * FROM server_team';
        
        return $this->db->select_object($query,[],'Team');
    }

    /**
     * Keys and values must be arrays as key/value pairs
     */
    public function get_teams_by_value($keys,$values){
        $query = 'SELECT * FROM server_team WHERE '.DatabaseHelpers::configure_update_parameters($keys);

        return $this->db->select_object($query,$values,'Team');
    }

    public function modify_team($new_team, $team_id){

    }



}


?>