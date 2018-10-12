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

    public function get_all_users(){
        $query = 'SELECT * FROM server_user';
        
        return $this->db->select_object($query,[],'User');  
    }

    public function get_user_by_username($username){
        $query      = "SELECT * FROM server_user WHERE username=?";
        return $this->db->select_object($query,[$username],'User')[0];

    }

    public function get_users_by_value($keys, $values){
        $query = 'SELECT * FROM server_user WHERE '.DatabaseHelpers::configure_update_parameters($keys);

        return $this->db->select_object($query,$values,'User');
    }

    public function get_users_by_selector_query($selector_query,$values){
        $query = 'SELECT * FROM server_user WHERE '.$selector_query;

        return $this->db->select_object($query,$values,'User');
    }

    public function modify_user($new_user,$old_username){
        $params     = $new_user->db_config();
        $keys       = $params['keys'];
        $values     = $params['values'];
        
        $query      = 'UPDATE server_user SET '.
                      DatabaseHelpers::configure_update_parameters($keys,$values).
                      ' WHERE username = ?';

        foreach($values as $key=>$value){
            if($value === 'null'){
                unset($values[$key]);
            }
        }
        array_push($values,$old_username);

        return $this->db->alter($query,$values);
    }

    public function delete_user($username){
        $query = "DELETE FROM server_user WHERE username = ?";
        $params = [$username];

        return $this->db->alter($query,$params);
    }


}
?>