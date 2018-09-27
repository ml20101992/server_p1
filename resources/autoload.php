<?php


spl_autoload_register(function($class){
    $base_dir = __dir__;
    
    $prefixes = [
        "db_controllers"            => "/controllers/db_controllers/",
        "auth_controllers"          => "/controllers/auth_controllers/",
        "model_controllers"         => "/controllers/model_controllers/",
        "view_controllers"          => "/controllers/view_controllers/",
        "models"                    => "/models/",
        "views"                     => "/views/"
    ];
     
    
    foreach($prefixes as $prefix){
        //normalize class name
        $class_filename = $base_dir . $prefix . str_replace('\\', '/', $class ) . '.php';

        //require class
        if(file_exists($class_filename) ) {
            require_once ($class_filename);
        return;
        }
                                   
    }
    
    return;
        
          

})


?>