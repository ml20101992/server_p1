<?php
class RoleController{
    private $db;

    public function __construct(){
        $this->db = new DatabaseController();
    }

    public function get_role_name($id){
        $query = "SELECT * FROM server_roles WHERE id = ?";
        $param = [$id];

        return $this->db->select_object($query, $param, "Role")[0];
    }
}