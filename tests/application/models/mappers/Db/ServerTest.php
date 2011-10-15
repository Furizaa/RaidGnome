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
class TestGnome_Model_Mapper_Db_ServerTest extends BowShock_Test_DatabaseTestCase
{

    /**
     * @var Gnome_Model_Mapper_Db_Server
     */
    private $mapper;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->mapper = new Gnome_Model_Mapper_Db_Server();
        $this->dbTable = new Gnome_Model_DbTable_Server();
    }

	/**
	 * (non-PHPdoc)
     * @see PHPUnit_Extensions_Database_TestCase::getDataSet()
     */
    protected function getDataSet()
    {
        return $this->createFlatXMLDataSet('tests/_files/fixtures/Server/install.xml');
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
     * Tests Gnome_Model_Mapper_Db_Server->toArray()
     */
    public function testToArray()
    {
        $data = array(
            'name' => "Gul'dan",
            'region' => BowShock_WowApi_Region::REGION_EUROPE,
        	'created_at' => '0000-00-00 00:00:00',
            'updated_at' => '0000-00-00 00:00:00',
            'id'	=> 80,
            'slug' => 'guldan',
            'type' => Gnome_Model_Server::TYPE_PVE
        );

        $model = new Gnome_Model_Server();
        $model->setOptions($data);

        $dataArray = $this->mapper->toArray($model);
        $this->assertEquals($data, $dataArray);
    }

    public function testFindLikeName()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $list = $this->mapper->findLikeName('Gu');
        $this->assertSame(1, count($list));
    }

    public function testFindByModelAndSlug()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $model = $this->mapper->findBySlugAndRegion('guldan', BowShock_WowApi_Region::REGION_EUROPE);
        $this->assertSame(1, $model->getId());
    }

    /**
     * @depends testFindByModelAndSlug
     */
    public function testFindByModelAndSlugReturnsNull()
    {
        $this->mapper->registerDbTable($this->dbTable);
        $model = $this->mapper->findBySlugAndRegion('foobar', BowShock_WowApi_Region::REGION_EUROPE);
        $this->assertNull($model);
    }

    /**
     * @depends testFindByModelAndSlugReturnsNull
     */
    public function testUpdateFromList()
    {
        $upServer = new Gnome_Model_Server();
        $upServer->setName('Eìtrig');
        $upServer->setRegion(BowShock_WowApi_Region::REGION_US);
        $upServer->setSlug('eitrig');
        $upServer->setType(Gnome_Model_Server::TYPE_RP);

        $newServer = new Gnome_Model_Server();
        $newServer->setName("Kil'jaeden");
        $newServer->setRegion(BowShock_WowApi_Region::REGION_EUROPE);
        $newServer->setSlug('kiljaeden');
        $newServer->setType(Gnome_Model_Server::TYPE_PVE);

        $serverList = new App_List_Server();
        $serverList->add($upServer);
        $serverList->add($newServer);

        $this->mapper->registerDbTable($this->dbTable);
        $this->mapper->updateFromList($serverList);

        $this->assertDbEqualsXml($this->mapper->getDbTable(), 'tests/_files/fixtures/Server/listupdate.xml');
    }

}