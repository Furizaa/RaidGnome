<?php
/**
 * Gnome
 *
 * @category   Gnome
 * @package    ModelMapper
 * @subpackage Db
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Test Case
 *
 * @package    ModelMapper
 * @subpackage Db
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class TestGnome_ModelMapper_Db_AccountTest extends BowShock_Test_DatabaseTestCase
{

    /**
     * @var Gnome_Model_Mapper_Db_Account
     */
    private $mapper;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->mapper = new Gnome_Model_Mapper_Db_Account();
        $this->dbTable = new Gnome_Model_DbTable_Account();
    }

	/**
	 * (non-PHPdoc)
     * @see PHPUnit_Extensions_Database_TestCase::getDataSet()
     */
    protected function getDataSet()
    {
        return $this->createFlatXMLDataSet('tests/_files/fixtures/Account/install.xml');
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->mapper = null;
        parent::tearDown();
    }

    /**
     * Update db record
     */
    protected function helperUpdateData()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $updateData = array(
            'email' => 'testing2@raidster.com',
            'verified' => 1
        );
        $model = new Gnome_Model_Account();
        $model->setOptions(array("id" => 1));
        $this->mapper->save($model, $updateData);
    }

    /**
     * Tests Gnome_Model_Mapper_Db_Account->toArray()
     */
    public function testToArray()
    {
        $data = array(
            'email' => 'testing@raidster.com',
            'password' => '123456789',
            'unique_key' => 'asdf-fdsa',
            'verified' => true,
            'created_at' => '0000-00-00 00:00:00',
            'updated_at' => '0000-00-00 00:00:00',
            'id'	=> 80
        );

        $model = new Gnome_Model_Account();
        $model->setOptions($data);

        $dataArray = $this->mapper->toArray($model);
        $this->assertEquals($data, $dataArray);
    }

    public function testKeyExists()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $this->assertTrue($this->mapper->keyExists('abcd-efgh'));
        $this->assertFalse($this->mapper->keyExists('abcd-efgx'));
    }

    /**
     *
     * @expectedException BowShock_Mapper_NotFoundException
     */
    public function testFindByEmailThrowsException()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $this->mapper->findByMail('boogus');
    }

    public function testFindByEmail()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $model = $this->mapper->findByMail('testing@raidster.com');
        $this->assertSame('testing@raidster.com', $model->getEmail());
    }

    public function testUpdateData()
    {
        $this->helperUpdateData();
        $this->assertDbEqualsXml($this->mapper->getDbTable(), 'tests/_files/fixtures/Account/update.xml');
    }

    public function testInsertData()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $insertData = array(
            'email'	=> 'testing-insert@raidster.com',
            'password' => 'ce04fe357bc67be9be8f97f0a07e36dc7b63edfc',
            'unique_key'	=> 'asdf-ghjk'
        );

        $model = new Gnome_Model_Account();
        $this->mapper->save($model, $insertData);

        $this->assertDbEqualsXml($this->mapper->getDbTable(), 'tests/_files/fixtures/Account/insert.xml');
    }

    public function testFindData()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $model = $this->mapper->find(1, new Gnome_Model_Account());
        $this->assertNotNull($model);
    }

    public function testResultIsNullIfNoDataCanBeFound()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $model = $this->mapper->find(2, new Gnome_Model_Account());
        $this->assertNull($model);
    }

    public function testTransactionRollback()
    {
        $this->mapper->startTransaction();
        $this->helperUpdateData();
        $this->mapper->rollbackTransaction();
        $this->assertDbEqualsXml(
            $this->mapper->getDbTable(),
            'tests/_files/fixtures/Account/install.xml',
            array(),
            array('server', 'group')
        );
    }

    public function testTransactionCommit()
    {
        $this->mapper->startTransaction();
        $this->helperUpdateData();
        $this->mapper->commitTransaction();
        $this->assertDbEqualsXml($this->mapper->getDbTable(), 'tests/_files/fixtures/Account/update.xml');
    }

    /**
     * @expectedException BowShock_Mapper_Exception
     */
    public function testTransactionLockOpen()
    {
        $this->mapper->startTransaction();
        $this->mapper->startTransaction();
    }

	/**
     * @expectedException BowShock_Mapper_Exception
     * @depends testTransactionLockOpen
     */
    public function testTransactionLockRollback()
    {
        $this->mapper->rollbackTransaction();
    }

	/**
     * @expectedException BowShock_Mapper_Exception
     * @depends testTransactionLockRollback
     */
    public function testTransactionLockCommit()
    {
        $this->mapper->commitTransaction();
    }
}