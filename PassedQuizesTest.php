<?php

/**
 * PassedQuizes test case.
 */
include_once 'Configeration/DB_Class.php';
include_once 'Models/passedquiz.php';
class PassedQuizesTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var PassedQuizes
     */
    private $passedQuizes;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated PassedQuizesTest::setUp()
        $database=new Database();
        $db=$database->connect();
        $this->passedQuizes = new PassedQuizes($db);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated PassedQuizesTest::tearDown()
        $this->passedQuizes = null;
        
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
     * Tests PassedQuizes->read()
     */
    public function testRead()
    {
        // TODO Auto-generated PassedQuizesTest->testRead()
        $res = $this->passedQuizes->read();
        $this->assertNotEmpty($res);
        if ($this)
            $this->markTestIncomplete("Query excuted successfully");
    }
}

