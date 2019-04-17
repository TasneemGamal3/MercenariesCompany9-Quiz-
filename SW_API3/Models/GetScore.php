<?php 
class GetScore{
    private $conn;
    private $table='passedquiz';
    public $UserID;
    public $QuizID;
	public $UserScore;
	public $Skill;
    public function __construct($db){
     $this->conn=$db;
    }

    public function read(){
        $query='SELECT p.UserID,p.UserScore,q.Skill
         FROM '.$this->table.' P JOIN quizinfo q ON p.QuizID=q.QuizID
         ';
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>