<?php
header('Access-Control-Allow-Origin: *');   
header('Content-Type: application/jason');

include_once  '../../Configeration/DB_Class.php';
include_once  '../../Models/passedquiz.php';

$database=new Database();
$db=$database->connect();

$passedQuizes=new PassedQuizes($db);

$result=$passedQuizes->read();
$num=$result->rowCount();

if($num>0){
    $passed_arr=array();
    $passed_arr['data']=array();
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
     extract($row);
     $Item=array(
    'UserID'=>$UserID,
    'QuizID'=>$QuizID,
     );
     array_push($passed_arr['data'],$Item);
    }
    echo json_encode($passed_arr);
    
}
else{
   echo json_encode(
array('message'=>'No passed Quizzes Found'));

}
?>