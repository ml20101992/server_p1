<?php
class Season{
    private $id;
    private $year;
    private $description;

    public function setValues($year, $desc){
        $this->description = $desc;
        $this->year = $year;
    }

    public function get_id(){return $this->id;}
    public function get_year(){return $this->year;}
    public function get_description(){return $this->description;}
}



?>