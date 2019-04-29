<?php
/**
 * addquiz test case.
 */
include_once '../Configeration/DB_Class.php';

class TestAddQuiz extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Database
     */
    private $database;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated TestDB::setUp()
        
        $this->database = new Database();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated TestDB::tearDown()
        $this->database = null;
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }

    /**
     * Tests Inesrt quiz into Database
     */
    public function testInsert()
    {
        $QuizID;
        $Title;
        $Skill;
        $PassScore;
        $NumOfQuestions;
        $ExpectedDuration;
        $conn = $this->database->connect();
        $query = 'SELECT * FROM quizinfo ORDER BY QuizID DESC LIMIT 1';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $LastInsertion = array();
        $LastInsertion['data'] = array();
        $Test = array();
        $Test['data'] = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $Item = array(
                'QuizID' => $QuizID,
                'Title' => $Title,
                'Skill' => $Skill,
                'PassScore' => $PassScore,
                'NumOfQuestions' => $NumOfQuestions,
                'ExpectedDuration' => $ExpectedDuration
            
            );
            array_push($LastInsertion['data'], $Item);
        }
        //After any insert we will change the values here with the new values insterted into Database
         $Item = array(
            'QuizID' => "",
            'Title' => "",
            'Skill' => "",
            'PassScore' => "",
            'NumOfQuestions' => "",
            'ExpectedDuration' => ""
        );
        array_push($Test['data'], $Item);
        $this->assertEquals($Test, $LastInsertion);
        if ($this)
            $this->markTestIncomplete("Insertion Done Correctly");
    }
}
?>