<?php

/**
 * Database test case.
 */
include_once 'Configeration/DB_Class.php';

class TestDB extends PHPUnit_Framework_TestCase
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
        
        $this->database = new Database(/* parameters */);
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
     * Tests Database->connect()
     */
    public function testConnect()
    {
        // TODO Auto-generated TestDB->testConnect()
        $conn = $this->database->connect(/* parameters */);
        $this->assertNotEquals(null, $conn);
        // $this->assertEquals(null, $conn);
        if ($this)
            $this->markTestIncomplete("Connection Done");
            //echo "Connection Done";
    }
}

