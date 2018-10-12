<?php
class SeasonController{
    private $db;

    public function __construct(){
        $this->db = new DatabaseController();
    }

    public function add_season($season){
        $query = "INSERT INTO server_season(year,description) VALUES(?,?)";
        $params = [$season->get_year(), $season->get_description()];

        return $this->db->alter($query,$params);
    }

    public function get_season_by_id($id){
        $query = "SELECT * FROM server_season WHERE id = ?";

        return $this->db->select_object($query,[$id],'Season')[0];
    }

    public function get_all_seasons(){
        $query = "SELECT * FROM server_season";

        return $this->db->select_object($query,[],'Season');
    }

    public function modify_season($new_season, $season_id){
        $query = "UPDATE server_season SET year = ?, description = ? WHERE id = ?";
        $params = [$new_season->get_year(), $new_season->get_description(),$season_id];

        return $this->db->alter($query, $params);

    }

    public function delete_season($season_id){
        $query = "DELETE FROM server_season WHERE id = ?";
        $params = [$season_id];

        return $this->db->alter($query, $params);
    }
}

?>