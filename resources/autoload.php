<?php


spl_autoload_register(function($class){
    $base_dir = __dir__;
    
    $prefixes = [
        "DatabaseController"        => "/controllers/db_controllers/",
        "DatabaseHelpers"        => "/controllers/db_controllers/",
        "UserController"            => "/controllers/model_controllers/",
        "Model"                     => "/models/",
        "User"                      => "/models/"
    ];
     
            
    //normalize class name
    $class_filename = $base_dir . $prefixes[$class] . str_replace('\\', '/', $class ) . '.php';

    //require class
    if(file_exists( $class_filename ) ) {
        require_once ($class_filename);
        return;
                                   
    }

    //return;
        
          

})


?>