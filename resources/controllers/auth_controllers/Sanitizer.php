<?php
class Sanitizer{
    public static function sanitize($value, $filter){
        // var_dump($value);
        // $return_value = Sanitizer::escape($value,$filter);


        // return Sanitizer::validate($return_value,$filter);
        return $value;
    }

    private static function escape($value, $filter){
   
        switch($filter){
            case 'default': return filter_var($value,FILTER_SANITIZE_STRING);          //default filter, used for everything containing strings             
        }

        
    }

    private static function validate($value, $filter){
        //todo odradi validaciju do kraja
        
        return $value;
    }




}
?>