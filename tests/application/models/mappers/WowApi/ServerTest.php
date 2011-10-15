<?php
/**
 * Gnome
 *
 * @category   Gnome
 * @package    ModelMapper
 * @subpackage WowApi
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Test Case
 *
 * @package    ModelMapper
 * @subpackage WowApi
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class TestGnome_Model_Mapper_WowApi_ServerTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Gnome_Model_Mapper_WowApi_Server
     */
    private $mapper;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->mapper = new Gnome_Model_Mapper_WowApi_Server();
        $this->adapter = new Zend_Http_Client_Adapter_Test();
        $this->mapper->getClient()->setAdapter($this->adapter);
    }

    /**
     * @expectedException BowShock_Mapper_NotFoundException
     */
    public function test404ThrowsException()
    {
        $response = new Zend_Http_Response(404, array());
        $this->adapter->setResponse($response);
        $this->mapper->getList();
    }

	/**
     * @expectedException BowShock_WowApi_Exception
     */
    public function testWrongStatusThrowsException()
    {
        $response = new Zend_Http_Response(500, array());
        $this->adapter->setResponse($response);
        $this->mapper->getList();
    }

	/**
     * @expectedException BowShock_WowApi_Exception
     */
    public function testInvalidResultThrowsException()
    {
        $response = new Zend_Http_Response(200, array(), file_get_contents('tests/_files/wowapi/invalid.json'));
        $this->adapter->setResponse($response);
        $this->mapper->getList();
    }

    public function testGetServerList()
    {
        $response = new Zend_Http_Response(200, array(), file_get_contents('tests/_files/wowapi/serverlist.json'));
        $this->adapter->setResponse($response);

        $list = $this->mapper->getList();
        $this->assertSame(3, count($list));

        $iterator = $list->getIterator();
        $this->assertSame('eu', $iterator->current()->getRegion());
        $this->assertSame('pvp', $iterator->current()->getType());
        $this->assertSame('Aegwynn', $iterator->current()->getName());
        $this->assertSame('aegwynn', $iterator->current()->getSlug());
    }

}