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
class TestGnome_ModelMapper_Db_EventTest extends BowShock_Test_DatabaseTestCase
{

    /**
     * @var Gnome_Model_Mapper_Db_Event
     */
    private $mapper;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->mapper = new Gnome_Model_Mapper_Db_Event();
        $this->dbTable = new Gnome_Model_DbTable_Event();
    }

	/**
	 * (non-PHPdoc)
     * @see PHPUnit_Extensions_Database_TestCase::getDataSet()
     */
    protected function getDataSet()
    {
        return $this->createFlatXMLDataSet('tests/_files/fixtures/Event/install.xml');
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
        	'creator_id' => 1,
            'group_id' => 1,
            'name' => 'Blackwing Lair Retro',
            'type_id' => 1,
            'start' => '2020-01-01 12:00:00',
            'end' => '2020-01-01 15:00:00',
            'players' => 25,
            'status_id' => 5,
        	'created_at' => '0000-00-00 00:00:00',
            'updated_at' => '0000-00-00 00:00:00'
        );

        $model = new Gnome_Model_Event();
        $model->setOptions($data);

        $dataArray = $this->mapper->toArray($model);
        $this->assertEquals($data, $dataArray);
    }

    public function testFetchEvents()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $list = $this->mapper->fetchEvents(
            1,
            '2020-01-01 00:00:00',
            '2020-01-05 00:00:00'
        );
        $this->assertSame(2, count($list));
        return $list;
    }

    public function testFetchEventsByModel()
    {
        $this->mapper->registerDbTable($this->dbTable);

        $group = new Gnome_Model_Group();
        $group->setOptions(array('id' => 1));

        $dateStart = new Zend_Date('2020-01-01 00:00:00', 'YYYY-MM-d H:i:s');
        $dateEnd = new Zend_Date('2020-01-05 00:00:00', 'YYYY-MM-d H:i:s');

        $list = $this->mapper->fetchEvents($group, $dateStart, $dateEnd);
        $this->assertSame(2, count($list));
    }

    /**
     * @depends testFetchEvents
     * @param App_List_Event $list
     */
    public function testEventsInOrder(App_List_Event $list)
    {
        $firstEventId = $list->getIterator()->current()->getId();
        $this->assertSame(1, $firstEventId);
    }

}