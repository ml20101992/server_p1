<?php
class LeagueController{
    private $db;

    public function __construct(){
        $this->db = new DatabaseController();
    }

    public function add_new_league($league){
        $params     = $league->db_config();
        $keys       = $params['keys'];
        $values     = $params['values'];
    
        $query = 'INSERT INTO '.$params['table_name'].'('.DatabaseHelpers::getKeyString($keys).') VALUES ('.DatabaseHelpers::getParameterPlaceholders($values).');';

        if($this->db->alter($query,$values)) return true;
        else return false;
    }

    public function get_all_leagues(){
        $query = 'SELECT * FROM server_league';
        
        return $this->db->select_object($query,[],'League');
    }



    /**
     * value can be either id or name
     */
    public function get_league_by_value($key, $value){
        $query = 'SELECT * FROM server_league WHERE '.$key.' = ?;';
        return $this->db->select_object($query,[$value],'League');

    }

    public function modify_league($new_league,$old_league_id){
        $params     = $new_league->db_config();
        $keys       = $params['keys'];
        $values     = $params['values'];
        
        $query      = 'UPDATE server_league SET '.
                      DatabaseHelpers::configure_update_parameters($keys).
                      ' WHERE id = ?';

        array_push($values,$old_league_id);

        return $this->db->alter($query,$values);
    }

}

?>