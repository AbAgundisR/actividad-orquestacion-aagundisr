<?php
class Materia{
  
    // database connection and table name
    private $conn;
    private $table_name = "Reticula";
  
    // object properties
    public $id;
    public $nombre;
    public $semestre;
  
    // constructor with $db as database connection
    public function __construct(){
    }
}
?>