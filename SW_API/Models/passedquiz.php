<?php 
class PassedQuizes{
    private $conn;
    private $table='passedquiz';
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