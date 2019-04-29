<?php

/**
 * Asked test case.
 */
include_once 'Configeration/DB_Class.php';
include_once 'Models/asked.php';

class AskedTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Asked
     */
    private $asked;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated AskedTest::setUp()
        $database = new Database();
        $db = $database->connect();
        $this->asked = new Asked($db);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated AskedTest::tearDown()
        $this->asked = null;
        
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
     * Tests Asked->read()
     */
    public function testRead()
    {
        // TODO Auto-generated AskedTest->testRead()
        // $this->markTestIncomplete("read test not implemented");
        $res = $this->asked->read();
        $this->assertNotEmpty($res);
        if ($this)
            $this->markTestIncomplete("Query excuted successfully");
    }
}

