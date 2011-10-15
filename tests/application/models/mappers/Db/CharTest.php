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
class TestGnome_ModelMapper_Db_CharTest extends BowShock_Test_DatabaseTestCase
{

    /**
     * @var Gnome_Model_Mapper_Db_Char
     */
    private $mapper;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->mapper = new Gnome_Model_Mapper_Db_Char();
        $this->dbTable = new Gnome_Model_DbTable_Char();
    }

	/**
	 * (non-PHPdoc)
     * @see PHPUnit_Extensions_Database_TestCase::getDataSet()
     */
    protected function getDataSet()
    {
        return $this->createFlatXMLDataSet('tests/_files/fixtures/Char/install.xml');
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
     * Tests Gnome_Model_Mapper_Db_Char->toArray()
     */
    public function testToArray()
    {
        $data = array(
            'id' => 1,
        	'account_id' => 1,
            'server_id' => 1,
            'name' => 'Fleya',
            'faction' => 'alliance',
            'class' => 'rogue',
            'race' => 'worgen',
            'sex' => 'female',
            'level' => 85,
            'tree_first' => 8,
            'tree_second' => 33,
            'tree_third' => 8,
            'style_tank' => false,
            'style_heal' => false,
            'style_dps' => true,
            'gearlevel' => 364,
        	'created_at' => '0000-00-00 00:00:00',
            'updated_at' => '0000-00-00 00:00:00'
        );

        $model = new Gnome_Model_Char();
        $model->setOptions($data);

        $dataArray = $this->mapper->toArray($model);
        $this->assertEquals($data, $dataArray);
    }

    public function testFindByAccount()
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

}