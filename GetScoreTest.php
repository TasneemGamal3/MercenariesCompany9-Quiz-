<?php

/**
 * GetScore test case.
 */
include_once 'Configeration/DB_Class.php';
include_once 'Models/GetScore.php';
class GetScoreTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var GetScore
     */
    private $getScore;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated GetScoreTest::setUp()
        $database=new Database();
        $db=$database->connect();
        $this->getScore = new GetScore($db);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated GetScoreTest::tearDown()
        $this->getScore = null;
        
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
     * Tests GetScore->read()
     */
    public function testRead()
    {
        // TODO Auto-generated GetScoreTest->testRead()
        $res = $this->getScore->read();
        $this->assertNotEmpty($res);
        if ($this)
            $this->markTestIncomplete("Query excuted successfully");
        
    }
}

