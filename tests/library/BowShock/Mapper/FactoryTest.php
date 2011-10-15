<?php

require_once 'BowShock/Mapper/Factory.php';

require_once 'BowShock/Mapper/Db/TestDummy.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * BowShock_Mapper_Factory test case.
 * @covers BowShock_Mapper_Factory
 */
class TestBowShock_Mapper_FactoryTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var BowShock_Mapper_Factory
     */
    private $factory;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->factory = BowShock_Mapper_Factory::getInstance();
        $this->mapper  = new BowShock_Mapper_Db_TestDummy();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        BowShock_Mapper_Factory::resetInstance();
        parent::tearDown();
    }

    public function testGetInstance()
    {
        $this->assertInstanceOf('BowShock_Mapper_Factory', $this->factory);
    }

    public function testResetInstance()
    {
        $firstInstance = BowShock_Mapper_Factory::getInstance();
        BowShock_Mapper_Factory::resetInstance();
        $secondInstance = BowShock_Mapper_Factory::getInstance();
        $this->assertNotSame($firstInstance, $secondInstance);
    }

    public function testRegisterMapper()
    {
        $this->assertFalse($this->factory->isMapperRegistered($this->mapper));
        $this->factory->registerMapper($this->mapper);
        $this->assertTrue($this->factory->isMapperRegistered($this->mapper));
    }

    public function testGetMapperReturnsRegisteredMapper()
    {
        $this->factory->registerMapper($this->mapper);
        $mapper = $this->factory->getMapper('BowShock_Mapper_Db_TestDummy');
        $this->assertSame($mapper, $this->mapper);
    }

    public function testGetMapperCreatesNewMapper()
    {
        $mapper = $this->factory->getMapper('BowShock_Mapper_Db_TestDummy');
        $this->assertNotSame($mapper, $this->mapper);
    }

    public function testInvokeMagicMethodWithDefaultNamespace()
    {
        $mapper = $this->factory->getTestDummyMapper();
        $this->assertInstanceOf('BowShock_Mapper_Db_TestDummy', $mapper);
    }

    public function testInvokeMagicMethodWithCustomNamespace()
    {
        $this->factory->setMapperNamespace('BowShock_Mapper_Db');
        $mapper = $this->factory->getTestDummyMapper();
        $this->assertInstanceOf('BowShock_Mapper_Db_TestDummy', $mapper);
    }

    /**
     * @expectedException BowShock_Mapper_FactoryException
     */
    public function testInvokeInvalidMapperThrowsException()
    {
        $this->factory->getNotExistsMapper();
    }

	/**
     * @expectedException BowShock_Mapper_FactoryException
     */
    public function testInvokeInvalidMethodThrowsException()
    {
        $this->factory->totalBogus();
    }
}

