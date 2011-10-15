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
class TestGnome_ModelMapper_Db_ApplicationTest extends BowShock_Test_DatabaseTestCase
{

    /**
     * @var Gnome_Model_Mapper_Db_Application
     */
    private $mapper;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->mapper = new Gnome_Model_Mapper_Db_Application();
        $this->dbTable = new Gnome_Model_DbTable_Application();
    }

	/**
	 * (non-PHPdoc)
     * @see PHPUnit_Extensions_Database_TestCase::getDataSet()
     */
    protected function getDataSet()
    {
        return $this->createFlatXMLDataSet('tests/_files/fixtures/Application/install.xml');
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
     * Tests Gnome_Model_Mapper_Db_Account->toArray()
     */
    public function testToArray()
    {
        $data = array(
            'event_id' => 1,
            'char_id' => 1,
            'comment' => 'Comment',
            'status' => 'inidecicive',
            'partial_come' => '2020-01-01 15:00:00',
            'partial_go' => null,
            'created_at' => '0000-00-00 00:00:00',
            'updated_at' => '0000-00-00 00:00:00',
            'id'	=> 80
        );

        $model = new Gnome_Model_Application();
        $model->setOptions($data);

        $dataArray = $this->mapper->toArray($model);
        $this->assertEquals($data, $dataArray);
    }

    public function testFetchForEvent()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $list = $this->mapper->fetchForEvent(1);
        $this->assertSame(1, count($list));
    }

    /**
     * @depends testFetchForEvent
     */
    public function testFetchForEventWithModel()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $event = new Gnome_Model_Event();
        $event->setOptions(array('id' => 1));
        $list = $this->mapper->fetchForEvent($event);
        $this->assertSame(1, count($list));
    }

    /**
     * @depends testFetchForEventWithModel
     */
    public function testSaveAlwaysCreatesNewRecord()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $model = $this->mapper->find(1, new Gnome_Model_Application());
        $this->mapper->save($model, $this->mapper->toArray($model));
        $this->assertDbEqualsXml($this->mapper->getDbTable(), 'tests/_files/fixtures/Application/save.xml');
    }

}