<?php
class DatabaseOperations{

    private $db;

    public function __construct(){
        $this->db = new DatabaseController();
    }

    public function fetchUserByUsername(){

    }

    public function add($model){
        $params = $model->db_config();
        $keys = $params['keys'];
        $values = $params['values'];
    
        $query = 'INSERT INTO '.$params['table_name'].'('.$this->getKeyString($keys).') VALUES ('.$this->getParameterPlaceholders($values).');';

        $this->db->alter($query,$values);
    }

    /**
     * Constructs the key elements for prepared statement
     */
    private function getKeyString($keys){
        $key_string = "";
        foreach($keys as $key){
            $key_string.=$key.',';
        }

        $key_string = substr($key_string,0,-1);

        return $key_string;
    }

    private function getParameterPlaceholders($params){
        $param_string = "";
        for($i = 0; $i < sizeof($params); $i++ ){
            $param_string .= '?,';
        }

        $param_string = substr($param_string,0,-1);

        return $param_string;
    }

    




}
?>