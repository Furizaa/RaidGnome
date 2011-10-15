<?php

require_once 'BowShock/Model/TestDummy.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * BowShock_Model_Base test case.
 * @covers BowShock_Model_Base
 */
class TestBowShock_Model_BaseTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var BowShock_Model_TestDummy
     */
    private $base;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->base = new BowShock_Model_TestDummy();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->base = null;
        parent::tearDown();
    }

    /**
     * @covers BowShock_Model_Base
     * @covers BowShock_Model_TestDummy
     */
    public function testModelRemembersValues()
    {
        $this->base->setOptions(array(
        	'id' => 99,
        	'created_at' => '123',
        	'updated_at' => '456',
            'testValue'  => '789'
        ));
        $this->assertSame(99, $this->base->getId());
        $this->assertSame('123', $this->base->getCreatedAt());
        $this->assertSame('456', $this->base->getUpdatedAt());
        $this->assertSame('789', $this->base->getTestValue());
    }

}

