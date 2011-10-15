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
class TestGnome_ModelMapper_Db_GroupTest extends BowShock_Test_DatabaseTestCase
{

    /**
     * @var Gnome_Model_Mapper_Db_Group
     */
    private $mapper;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->mapper = new Gnome_Model_Mapper_Db_Group();
        $this->dbTable = new Gnome_Model_DbTable_Group();
    }

	/**
	 * (non-PHPdoc)
     * @see PHPUnit_Extensions_Database_TestCase::getDataSet()
     */
    protected function getDataSet()
    {
        return $this->createFlatXMLDataSet('tests/_files/fixtures/Group/install.xml');
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
     * Tests Gnome_Model_Mapper_Db_Group->toArray()
     */
    public function testToArray()
    {
        $data = array(
            'name' => "Shangri'la",
            'faction' => 'horde',
            'server_id' => 1,
            'creator_id' => 1,
            'created_at' => '0000-00-00 00:00:00',
            'updated_at' => '0000-00-00 00:00:00',
            'id'	=> 80
        );

        $model = new Gnome_Model_Group();
        $model->setOptions($data);

        $dataArray = $this->mapper->toArray($model);
        $this->assertEquals($data, $dataArray);
    }

    public function testFindId()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $model = $this->mapper->find(1, new Gnome_Model_Group());
        $this->assertEquals(1, $model->getId());
    }

    public function testFindIdReturnsNull()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $model = $this->mapper->find(9, new Gnome_Model_Group());
        $this->assertNull($model);
    }

    public function testFindLikeName()
    {
        $this->mapper->registerDbTable($this->dbTable);

        $list = $this->mapper->findLikeName('Sha'); // Finds Sha and Shangri'la
        $this->assertSame(2, count($list));

        $list = $this->mapper->findLikeName('Shan'); // Finds oly Shangri'la
        $this->assertSame(1, count($list));
    }

    public function testFindByCreator()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $list = $this->mapper->findByCreator(1);
        $this->assertSame(2, count($list));
    }

    public function testFindByAccountId()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $list = $this->mapper->findByAccount(1);
        $this->assertSame(2, count($list));
    }

    public function testFindByAccountModel()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $account = new Gnome_Model_Account();
        $account->setOptions(array('id' => 1));
        $list = $this->mapper->findByAccount($account);
        $this->assertSame(2, count($list));
    }

    public function testFindByAccountEmptyList()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $list = $this->mapper->findByAccount(2);
        $this->assertSame(0, count($list));
    }

}