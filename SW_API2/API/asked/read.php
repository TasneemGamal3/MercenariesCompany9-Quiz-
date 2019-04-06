<?php
header('Access-Control-Allow-Origin: *');   
header('Content-Type: application/jason');

include_once  '../../Configeration/DB_Class.php';
include_once  '../../Models/asked.php';

$database=new Database();
$db=$database->connect();

$ask=new Asked($db);

$result=$ask->read();
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
array('message'=>'No asked Quizzes Found'));

}
?>