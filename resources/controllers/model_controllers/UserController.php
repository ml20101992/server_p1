<?php
class UserController{

    private $db;

    public function __construct(){
        $this->db = new DatabaseController();
    }

    public function add_new_user($user){
        $params     = $user->db_config();
        $keys       = $params['keys'];
        $values     = $params['values'];
    
        $query = 'INSERT INTO '.$params['table_name'].'('.DatabaseHelpers::getKeyString($keys).') VALUES ('.DatabaseHelpers::getParameterPlaceholders($values).');';

        if($this->db->alter($query,$values)) return true;
        else return false; 
    }

    public function get_user_by_username($username){
        $query      = "SELECT * FROM server_user WHERE username=?";
        return $this->db->select_object($query,[$username],'User');

    }

    public function search_users($search_options){

    }

    public function modify_user($new_user,$old_username){
        $params     = $new_user->db_config();
        $keys       = $params['keys'];
        $values     = $params['values'];
        
        $query      = 'UPDATE server_user SET '.
                      DatabaseHelpers::configure_update_parameters($keys).
                      ' WHERE username = ?';

        array_push($values,$old_username);

        return $this->db->alter($query,$values);
    }


}
?>