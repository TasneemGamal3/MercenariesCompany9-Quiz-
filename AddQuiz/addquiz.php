<?php 
session_start();
$errors = [];
$title = "" ;
$skillType = "" ;
$passScore = "" ;
$qNum = "" ;
$expctDur = "" ;
$boolean=false;
$question = "";
$possibleSol = "";
$corrctOne = "";
$done=false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {		
	include('db.php');
	$pdo = DBFactory::getDBO();
	$title = $_POST['title'];
	$skillType = $_POST['skillType'];
	$passScore = $_POST['passScore'];
	$qNum = $_POST['qNum'];
	$expctDur = $_POST['expctDur'];


	
	if ($title == "") {
		array_push($errors, "Insert The Quiz_Title, PLease");
	} else {
		$stmt = $pdo->prepare("SELECT * FROM quizinfo WHERE title = ?");
		$stmt->execute([$title]);
		$count = $stmt->rowCount();

		if ($count > 0) {
			array_push($errors, "Title Is Already Taken");
		}
	}

	if ($skillType == "") {
		array_push($errors, "Enter The Skill_Type, PLease");
	} 

	if ($passScore == "") {
		array_push($errors, "Enter The pass_Score, PLease");
	}

	if ($qNum == "") {
		array_push($errors, "Enter Number OF Questions, Please");
	}
	if ($expctDur == "") {
		array_push($errors, "Enter Expected_Duration, Please");
	}
	if($boolean===true)
	{
		for( $i=0 ; $i < $qNum ; $i++)
		{
		$j = $i + 1;
		$name = "q" . $j;
		$ps = "ps" . $j;
		$co = "co" . $j;
		$question = $_POST[$name];
		$possibleSol = $_POST[$ps];
		$corrctOne = $_POST[$co];
		if ($question === "") {
			array_push($errors, "Enter The Question, Please");
		}
		if ($possibleSol === "") {
			array_push($errors, "Enter The Possible Solutions, Please");
		}
		if ($corrctOne === "") {
			array_push($errors, "Enter The Correct Solution, Please");
		}
		
		}
	}
	
	if (sizeof($errors) == 0) {
		$done=true;

		$stmt = $pdo->prepare('INSERT INTO `quizinfo` (`Title`, `Skill Type`, `Pass Score`, `Num Of Questions`, `Expected Duration`) VALUES (:title, :skillType, :passScore, :qNum, :expctDur)');
		$stmt->execute(array(
			'title' => $title,
			'skillType' => $skillType,
			'passScore' => $passScore,
			'qNum' => $qNum,
			'expctDur' => $expctDur
			
		));
	//	$_SESSION['qn'] = $qNum;
		$stmt = $pdo->prepare("SELECT * FROM quizinfo WHERE title = ?");
		$stmt->execute([$title]);
		$quiz = $stmt->fetch(PDO::FETCH_ASSOC);
		$QuizID=$quiz['QuizID'];
		
		if($boolean===true)
		{
			for( $i=0 ; $i < $qNum ; $i++)
			{	
				$j = $i + 1;
				$name = "q" . $j;
				$ps = "ps" . $j;
				$co = "co" . $j;
				$question = $_POST[$name];
				$possibleSol = $_POST[$ps];
				$corrctOne = $_POST[$co];
			$stmt = $pdo->prepare('INSERT INTO `question` (`QuizID`, `Question`, `Possible Solutions`, `Correct Solution`) VALUES (:QuizID, :question, :possible, :correct)');
			$stmt->execute(array(
			'QuizID' => $QuizID,
			'question' => $question,
			'possible' => $possibleSol,
			'correct' =>  $corrctOne
		));
		}
		}
		
		//echo "Done";
		//header("Location: index.php");
		
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>QUIZ_ADDING</title>
	<?php include("include.php") ?>
	<style>
		.form-group{
			width:50%;
			margin: 0 auto 30px;
		}
		.show{
			margin-top: 20px;
		}
		.text-left{
			margin-left: 50px;
			
		}
		#done{
			margin-right: 50px;
			margin-bottom: 40px;


		}
		#img{
			margin-top:30px;
		}
	</style>
	 
	
</head>
<body style="background-color:#f5f5f5; " class="text-center">
<div class="quizForm">

<div class="text-center" id="img">
<img src="https://img.icons8.com/flat_round/64/000000/question-mark.png" alt="" width="80" height="80">
	</div>
	<?php if($done==false)
	{
		echo'<div class="text-left" id="nodone">
		<div class="spinner-border" role="status">
			<span class="sr-only">Loading...</span>
			<h5>ADDING</h5>
		</div>
</div>';
	}
	?>
	
<br><br>


	
	<!-- onsubmit="addQuestions();return false;" -->
	<form class="form-group" method="post" >
	<?php include('error.php') ?>
		<div class="form-group">
			<label><h5>QUIZ_TITLE</h5></label>
			<input class="form-control" type="text" name="title" placeholder="Enter title" value="<?php echo $title; ?>">
				</div>

		<div class="form-group">
			<label><h5>SKILL_TYPE</h5></label>
			<input class="form-control" type="text" name="skillType" placeholder="Enter Skill type"  value="<?php echo $skillType; ?>">
		</div>

		<div class="form-group">
			<label><h5>PASS_SCORE</h5></label>
			<input class="form-control" type="text" name="passScore" placeholder="Enter Pass score" value="<?php echo $passScore; ?>" >
		</div>

		<div class="form-group">
			<label><h5># OF QUESTIONS</h5></label>
			<input class="form-control" type="text" id="qNum" name="qNum" placeholder="Enter Question number" value="<?php echo $qNum; ?>" >
			<button  name="showq" id="showq" class="btn btn-info show" >SHOW_QUESTIONS</button> 
			

		</div>

		<div id="container" class="">
		
 
 		</div>
 
		<div class="form-group">
			<label><h5>EXPECTED DURATION</h5></label>
			<input class="form-control" type="text" name="expctDur" placeholder="Enter Expected duration" value="<?php echo $expctDur; ?>" >
		</div>

		<div class="form-group">

			<button type="submit"  name="addquiz" class="btn btn-dark">ADD_QUIZ</button> 
			
		</div>
		<?php if($done==true)
		{
		//	<button type="button" class="btn btn-success" id="success">Success</button>

			echo'
			<img src="https://img.icons8.com/ultraviolet/40/000000/checked.png">
		
			';
		}
		?>

		
		
	</form>
</div>
 

 <script type='text/javascript'>
	 document.getElementById("showq").addEventListener("click", function(e){
		e.preventDefault();
		addQuestions(); })
        function addQuestions(){
			<?php $boolean=true; ?>
            // Number of inputs to create
            var number = document.getElementById("qNum").value;
            // Container <div> where dynamic content will be placed
            var container = document.getElementById("container");
            // Clear previous contents of the container
            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
			}
			container.appendChild(document.createElement("br"));

            for (i=0;i<number;i++){
				
                // Append a node with a random text
				container.appendChild(document.createTextNode("QUESTION " + (i+1)));
				container.appendChild(document.createTextNode('\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0'+"POSSIBLE SOLUTIONS " ));
                container.appendChild(document.createTextNode('\xa0\xa0\xa0\xa0\xa0'+"CORRECT ONE " ));
				container.appendChild(document.createElement("br"));

                // Create an <input> element, set its type and name attributes
				var input = document.createElement("input");
				var j=i+1;
                input.type = "text";
                input.name = "q" + j;
				container.appendChild(input);
				//////////////
				var input = document.createElement("input");
				var j=i+1;
                input.type = "text";
				input.name = "ps" + j;
				input.class = "form-control";
				container.appendChild(input);
				/////////////
				var input = document.createElement("input");
				var j=i+1;
                input.type = "text";
                input.name = "co" + j;
                container.appendChild(input);
                // Append a line break 
                container.appendChild(document.createElement("br"));
			}
			container.appendChild(document.createElement("br"));
		/*	document.getElementById("success").onclick = function () {
        	location.href = "index.php";
		 */
		}
		////////////
	

    </script>

</body>
</html>