<?php 
class Asked{
    private $conn;
    private $table='asked';
    public $UserID;
    public $QuizID;
    public function __construct($db){
     $this->conn=$db;
    }

    public function read(){
        $query='SELECT *
         FROM '.$this->table.'
         ';
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>