<?php
class SportController{
    private $db;

    public function __construct(){
        $this->db = new DatabaseController();
    }

    public function add_sport($new_sport){
        $query = "INSERT INTO server_sport(name) VALUES(?)";
        $params = [$new_sport->get_name()];
        
        return $this->db->alter($query,$params);
    }

    public function get_sport_by_id($id){
        $query = "SELECT * FROM server_sport WHERE id = ?";
        $param = [$id];

        return $this->db->select_object($query, $param, "Sport")[0];
    }

    public function get_all_sports(){
        $query = "SELECT * FROM server_sport";
        $param = [];

        return $this->db->select_object($query, $param, "Sport");
    }

    public function modify_sport($new_sport, $sport_id){
        $query = "UPDATE server_sport SET name = ? WHERE id = ?";
        $params = [$new_sport->get_name(),$sport_id];

        return $this->db->alter($query, $params);
    }

    public function delete_sport($sport_id){
        $query = "DELETE FROM server_sport WHERE id = ?";
        
        return $this->db->alter($query, [$sport_id]);
    }
}



?>