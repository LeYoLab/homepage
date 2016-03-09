<?php
require 'flight/Flight.php';
require 'classes.php';

//$tmpRandomQuestionObject;

function createJSONQuest($alreadyArray = array()){
	//Quiz
	$quizObject = new Quiz();

	//Zufällige Frage holen
	$randomQuestionObject = $quizObject->getRandomQuestion();

	while (in_array($randomQuestionObject->getID(), $alreadyArray))
	{
		$randomQuestionObject = $quizObject->getRandomQuestion();
	}

		//Die dazugehörigen Antworten holen
		$answerObjectArray = $randomQuestionObject->getAnswers();

		//Antworten shufflen
		shuffle($answerObjectArray);

		$lululu = array('q1' => $randomQuestionObject->getQuestion(), 'id' => $randomQuestionObject->getID());
		$i = 0;
		foreach($answerObjectArray as $ans){
			$lululu['a'.$i] = $ans->getAnswer();
			$i++;
		}

		echo json_encode($lululu);
}

Flight::route('/getQuestion', function(){

	

});

Flight::route('/checkQuestion/@answer', function($answer){

	$iscorrect=false;
	$tmpding = explode("::", $answer);
	$answer=$tmpding[0];
	$id=$tmpding[1];
	$tmpQuizObject=new Quiz();
	$tmpQuestionObject=$tmpQuizObject->getQuestionByID($id);
	$tmpAnswerString = $tmpQuestionObject->getCorrectAnswer();
	if ($answer == $tmpAnswerString){
		$iscorrect=true;
	}
	echo json_encode($iscorrect);
});


Flight::route('/nextQuest/@previousQuestID', function($previusQuestID){



});

Flight::start();
?>
 