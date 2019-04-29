<?php 
session_start();

$skillQuiz="";
$quizinfo="";
$questioninfo=[];
$countQuestion=0;
$count=0;
$quizId="";
$errors = [];
$ids = [];
$userScore=0;
$chk=false;
$passScore=0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {		
	include('db.php');
	$pdo = DBFactory::getDBO();
    $skillQuiz = $_POST['skillQuiz'];


    
	if ($skillQuiz == "") {
		array_push($errors, "Insert The Skill Quiz, PLease");
	} 
    
    $stmt = $pdo->prepare('SELECT * FROM quizinfo WHERE Skill = :skillQuiz');
    $stmt->execute(array(
        'skillQuiz' => $skillQuiz
    ));

    $quizinfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();

		if ($count == 0) {		
				array_push($errors, "There Is No Quizzes With This Skill Type");		
        }
$quizId = $quizinfo['QuizID'];

$stmt = $pdo->prepare('SELECT * FROM question WHERE QuizID = :quizId');
$stmt->execute(array(
    'quizId' => $quizId
));
$questioninfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
$countQuestion = $stmt->rowCount();

if ($countQuestion == 0) {		
    array_push($errors, "There Is No Questions");		
}
/*
for($i=0;$i<$countQuestion;$i++)
{
    echo $questioninfo[$i]['QuestionID'] . " * " ;
    echo $questioninfo[$i]['Question'] . " * " ;
    echo $questioninfo[$i]['PossibleSolutions'] . " *   " ;

}

 echo $quizinfo['QuizID']. "    *   ";  
 echo $quizinfo['Title']. "    *   ";   
 echo $quizinfo['Skill']. "    *   ";   
 echo $quizinfo['PassScore']. "    *   ";   
 echo $quizinfo['NumOfQuestions']. "    *   ";   
 echo $quizinfo['ExpectedDuration']. "    *   "; 
*/
 
$quizId = $quizinfo['QuizID'];
$passScore = $quizinfo['PassScore'];
$quesNum = $quizinfo['NumOfQuestions'];
if($quesNum!=0){//$quesScore = $passScore / $quesNum;
	$quesScore=1;}
$correct="";
$select="";
$userId = 10;
for($i=0;$i<$countQuestion;$i++){   
    if(isset($_POST[$i])){
        $select=$_POST[$i];
        //echo "You have selected :".$select;//  Displaying Selected Value   
        $chk = true;

		} 
       $correct = $questioninfo[$i]['CorrectSolution'];
       if($correct == $select)
       {
		    //error_reporting(0);
            $userScore+=$quesScore;
       }

}

//echo "YOUR SCORE: ". $userScore;
//error_reporting(0);

if($userScore>=$passScore){
$stmt = $pdo->prepare('INSERT INTO `passedquiz` (`UserID`, `QuizID`, `UserScore`) VALUES (:userId, :quizId, :userScore)');
//error_reporting(0);
		$stmt->execute(array(
			'userId' => $userId,
			'quizId' => $quizId,
			'userScore' => $userScore
			
        ));
       // echo "passed";
}




}


?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>DISPLAY QUIZ</title>
	<?php include("include.php") ?>

    <style>
		.form-group{
			width:50%;
			margin: 0 auto 30px;
            margin-top:30px;

		}
        </style>
    </head>
<body style="background-color:#f5f5f5; " class="text-center">
<form class="form-group" method="post" >
	<?php include('error.php') ?>




<?php

//error_reporting(0);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {	
    if($userScore>=$passScore){
        echo'<div class="alert alert-success" role="alert"> ';
        echo'<h1 ><span class="label label-default">PASSED</span> </h>'; 
        echo'</div> ';
    }
    if($userScore<$passScore && $chk==true){
        echo'<div class="alert alert-danger" role="alert"> ';
        echo'<h1 ><span class="label label-default">FAILED</span> </h>'; 
        echo'</div> ';    }
}
    
   ?>

    <div class="form-group">
			<label><h5>QUIZ SKILL</h5></label>
			<input class="form-control" type="text" name="skillQuiz" placeholder="Enter Skill Of Quiz You Want" value="<?php echo $skillQuiz; ?>" >
		</div>

		<div class="form-group">
			<button type="submit"  name="startquiz" class="btn btn-dark">START QUIZ</button> 			
		</div>


        <?php
/*for($i=0;$i<$countQuestion;$i++)
        {
            error_reporting(0);

            echo"
            <div class='product-card'>           
            <h2> ${questioninfo[$i]['QuestionID']}</h2> 
            <h4> ${questioninfo[$i]['Question']}</h4> 
            <h4> ${questioninfo[$i]['PossibleSolutions']}</h4> 
            </div>
                ";
        }*/

     

			/*	foreach ($questioninfo as $qinfo) {
					echo "
						<div class='product-card'>
							<h2>${qinfo['Question']}</h2>
							<h4>${qinfo['PossibleSolutions']}</h4>														
						</div>
					";
				}*/
			?>

<div class='product-card'>
<?php $radio=-1; ?>
<?php foreach ($questioninfo as $qinfo) : ?>
<?php $radio++; ?>

        
      
        <h4>
     <?php echo  $qinfo['Question'] ?> 
        </h4>
        <?php $arr=[];
        $arr = explode(",",$qinfo['PossibleSolutions']);
        ?>
        
        <input type="radio"  name="<?php echo $radio ?>" value="<?php echo $arr[0] ?>" > <?php echo $arr[0] ?> <br>
        <input type="radio"  name="<?php echo $radio ?>" checked="checked" value="<?php echo $arr[1] ?>"> <?php echo $arr[1] ?> <br>
        <input type="radio"  name="<?php echo $radio ?>" value="<?php echo $arr[2] ?>" > <?php echo $arr[2] ?> <br>

       <!-- Default unchecked 
<div class="custom-control custom-radio">
  <input type="radio" class="custom-control-input" id="defaultGroupExample1" name=" <br>
  <label class="custom-control-label" for="defaultGroupExample1"></label>

</div>

<div class="custom-control custom-radio">
  <input type="radio" class="custom-control-input" id="defaultGroupExample2" name=" <br>
  <label class="custom-control-label" for="defaultGroupExample2"></label>

</div>

<div class="custom-control custom-radio">
  <input type="radio" class="custom-control-input" id="defaultGroupExample3" name=" <br>
  <label class="custom-control-label" for="defaultGroupExample3"></label>

</div>
-->

  <?php endforeach ?>
  </div>
  <input type="submit" class="btn btn-light" name="submitq" value="Get Selected Values" />



    </form>

    



</body>
</html>
