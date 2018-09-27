<?php
class Sanitizer{
    private $validation_filters = [
        'username'          => ''
    ];
    public function __construct(){

    }

    public static function sanitize($value, $filter){
        $return_value = Sanitizer::escape($value,$filter);


        return Sanitizer::validate($return_value,$filter);
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