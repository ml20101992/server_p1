<?php
class DatabaseHelpers{

    /**
     * Constructs the key elements for prepared statement
     */
    public static function getKeyString($keys){
        $key_string = "";
        foreach($keys as $key){
            $key_string.=$key.',';
        }

        $key_string = substr($key_string,0,-1);

        return $key_string;
    }

    public static function getParameterPlaceholders($params){
        $param_string = "";
        for($i = 0; $i < sizeof($params); $i++ ){
            $param_string .= '?,';
        }

        $param_string = substr($param_string,0,-1);

        return $param_string;
    }

    public static function configure_update_parameters($keys){
        $update_params = "";
        foreach($keys as $key){
            $update_params .= $key .' = ?,';
        }

        $update_params = substr($update_params,0,-1);

        return $update_params;
    }

    




}
?>