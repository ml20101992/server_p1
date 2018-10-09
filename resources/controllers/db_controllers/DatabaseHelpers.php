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

    public static function configure_update_parameters($keys,$values){
        $update_params = "";
        $index = 0;
        foreach($keys as $key){
            if($values[$index] !== "null"){
                $update_params .= $key .' = ?, ';
            }
            else{
                unset($key);
            }
            $index++;
        }

        $update_params = substr($update_params,0,-2);

        return $update_params;
    }



    




}
?>