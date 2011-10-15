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
class TestGnome_ModelMapper_Db_AccountToGroupTest extends BowShock_Test_DatabaseTestCase
{

    /**
     * @var Gnome_ModelMapper_Db_AccountToGroup
     */
    private $mapper = null;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->dbTable = new Gnome_Model_DbTable_AccountToGroup();
        $this->mapper = new Gnome_Model_Mapper_Db_AccountToGroup();
        $this->mapper->registerDbTable($this->dbTable);
    }

	/**
	 * (non-PHPdoc)
     * @see PHPUnit_Extensions_Database_TestCase::getDataSet()
     */
    protected function getDataSet()
    {
        return $this->createFlatXMLDataSet('tests/_files/fixtures/AccountToGroup/install.xml');
    }

    public function testAddAccountToGroup()
    {
        $this->mapper->addAccountToGroup(2, 1); //Add Account 2 to Group 1
        $this->assertDbEqualsXml($this->mapper->getDbTable(), 'tests/_files/fixtures/AccountToGroup/addToGroup.xml');
    }

    /**
     * @depends testAddAccountToGroup
     */
    public function testAddAccountToGroupWithModels()
    {
        $group = new Gnome_Model_Group();
        $group->setOptions(array('id' => 1));
        $account = new Gnome_Model_Account();
        $account->setOptions(array('id' => 2));

        $this->mapper->addAccountToGroup($account, $group); //Add Account 2 to Group 1
        $this->assertDbEqualsXml($this->mapper->getDbTable(), 'tests/_files/fixtures/AccountToGroup/addToGroup.xml');
    }

    /**
     * @depends testAddAccountToGroupWithModels
     */
    public function testRemoveAccountFromGroup()
    {
        $this->mapper->addAccountToGroup(2, 1); //Add Account 2 to Group 1
        $this->mapper->removeAccountFromGroup(1, 1); //Remove Account 1 from Group 1
        $this->assertDbEqualsXml(
            $this->mapper->getDbTable(),
            'tests/_files/fixtures/AccountToGroup/removeFromGroup.xml'
        );
    }

	/**
     * @depends testRemoveAccountFromGroup
     */
    public function testRemoveAccountFromGroupWithModels()
    {
        $group = new Gnome_Model_Group();
        $group->setOptions(array('id' => 1));
        $account = new Gnome_Model_Account();
        $account->setOptions(array('id' => 1));

        $this->mapper->addAccountToGroup(2, 1); //Add Account 2 to Group 1
        $this->mapper->removeAccountFromGroup($account, $group); //Remove Account 1 from Group 1
        $this->assertDbEqualsXml(
            $this->mapper->getDbTable(),
            'tests/_files/fixtures/AccountToGroup/removeFromGroup.xml'
        );
    }

	/**
     * @depends testRemoveAccountFromGroup
     * @expectedException BowShock_Mapper_NotFoundException
     */
    public function testRemoveNonexistendThrowsException()
    {
        $this->mapper->removeAccountFromGroup(99, 1); //Remove Account 99 from Group 1
    }

    /**
     * @depends testRemoveNonexistendThrowsException
     */
    public function testUpdateStatus()
    {
        $group = new Gnome_Model_Group();
        $group->setOptions(array('id' => 1));
        $account = new Gnome_Model_Account();
        $account->setOptions(array('id' => 1));

        $this->mapper->setStatus($account, $group, Gnome_Model_Group::ACCOUNT_STATUS_MEMBER);

        $this->assertDbEqualsXml(
            $this->mapper->getDbTable(),
            'tests/_files/fixtures/AccountToGroup/status.xml'
        );
    }

	/**
     * @depends testUpdateStatus
     * @expectedException BowShock_Mapper_NotFoundException
     */
    public function testUpdateNonexistendThrowsException()
    {
        $this->mapper->setStatus(1, 99, Gnome_Model_Group::ACCOUNT_STATUS_MEMBER);
    }

}