<?php
define("DB_USER","root");
define("DB_PASS","bSqq1eqS");
define("DB_TYPE","mysql");
define("DB_HOST","localhost");
define("DB_PORT","3306");
define("DB_DATABASE","mxl3773");

class DatabaseController{

    private $db;

    public function __construct(){
        
        
        //database conn string
        $dsn =  DB_TYPE.':host='.DB_HOST.
                ';dbname='.DB_DATABASE.
                ';charset=utf8mb4';

        //pdo options
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try{
            $this->db = new PDO($dsn,DB_USER,DB_PASS,$options);
        }catch(\PDOException $e){
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function select_object($query, $parameters, $class){
        // var_dump($query);
        // return;

        $statement = $this->db->prepare($query);
        $statement->execute($parameters);
        $statement->setFetchMode(PDO::FETCH_CLASS,$class);
        
        try{
            //check if there are returns
            $result = $statement->fetch();
            if($result === false){             //no results
                return false;
            }
            else{                                                       //results found
                return $result;
            }
        }catch(\PDOException $e){
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }


    }

    public function selectColumn($query,$params){
        
    }

    public function alter($query, $parameters){
        $statement = $this->db->prepare($query);
        $statement->execute($parameters);

        try{
            $statement->fetch();
        }catch(\PDOException $e){
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        return true;

    }
}


?>