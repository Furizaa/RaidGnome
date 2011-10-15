<?php

require_once 'BowShock/Model/DbTable/Factory.php';

require_once 'BowShock/Model/DbTable/TestDummy.php';

require_once 'PHPUnit/Framework/TestCase.php';

require_once 'BowShock/Mapper/Db/TestDummy.php';

require_once 'Zend/Db/Adapter/Pdo/Mysql.php';

/**
 * BowShock_Model_DbTable_Factory test case.
 * @covers BowShock_Model_DbTable_Factory
 */
class TestBowShock_Model_DbTable_FactoryTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var BowShock_Model_DbTable_Factory
     */
    private $factory;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->factory = BowShock_Model_DbTable_Factory::getInstance();
        $this->adapter = $this->getMock('Zend_Db_Adapter_Pdo_MySql', array(), array(), '', false);
        Zend_Db_Table_Abstract::setDefaultAdapter($this->adapter);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->factory->resetInstance();
        parent::tearDown();
    }

    public function testGetInstance()
    {
        $this->assertInstanceOf('BowShock_Model_DbTable_Factory', $this->factory);
    }

    public function testResetInstance()
    {
        $firstInstance = BowShock_Model_DbTable_Factory::getInstance();
        BowShock_Model_DbTable_Factory::resetInstance();
        $secondInstance = BowShock_Model_DbTable_Factory::getInstance();
        $this->assertNotSame($firstInstance, $secondInstance);
    }

    public function testSetDefaultTable()
    {
        $this->factory->setDefaultTable('Boogus');
        $this->assertSame('Boogus', $this->factory->getDefaultTable());
    }

    public function testSetTableForMapper()
    {
        $this->factory->setTableForMapper('TestTable', 'TestMapper');
        $this->assertSame('TestTable', $this->factory->getTableForMapper('TestMapper'));
    }

    public function testFactoryMethod()
    {
        $params = array(
            'default' => 'DefaultTable',
            'map' => array(
                'TestMapper' => 'TestTable'
            )
        );

        BowShock_Model_DbTable_Factory::factory($params);
        $this->assertSame('DefaultTable', $this->factory->getDefaultTable());
        $this->assertSame('TestTable', $this->factory->getTableForMapper('TestMapper'));
    }

    public function testCreateDefaultTable()
    {
        $this->factory->setDefaultTable('BowShock_Model_DbTable_TestDummy');
        $this->assertInstanceOf('BowShock_Model_DbTable_TestDummy', $this->factory->createMappedTable('...'));
    }

    public function testCreateMappedTable()
    {
        $this->factory->setTableForMapper('BowShock_Model_DbTable_TestDummy', 'BowShock_Mapper_Db_TestDummy');
        $mapper = new BowShock_Mapper_Db_TestDummy();
        $this->assertInstanceOf('BowShock_Model_DbTable_TestDummy', $this->factory->createMappedTable($mapper));
    }

    /**
     * @expectedException BowShock_Model_DbTable_FactoryException
     */
    public function testNoDefaultTableThrowsException()
    {
        $this->factory->createMappedTable('...');
    }

	/**
     * @expectedException BowShock_Model_DbTable_FactoryException
     */
    public function testRegisteredBogusTableThrowsException()
    {
        $this->factory->setTableForMapper('Boogus', 'BowShock_Mapper_Db_TestDummy');
        $this->factory->createMappedTable('BowShock_Mapper_Db_TestDummy');
    }

}

