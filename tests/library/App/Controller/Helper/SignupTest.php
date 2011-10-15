<?php
/**
 * App
 *
 * @category   App
 * @package    Controller
 * @subpackage Helper
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Test Case
 *
 * @package    Controller
 * @subpackage Helper
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class App_Controller_Helper_SignupTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var App_Controller_Helper_Signup
     */
    private $helper;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        BowShock_Mapper_Factory::getInstance()->setMapperNamespace('Gnome_Model_Mapper_Db');
        $this->helper = new App_Controller_Helper_Signup();
        parent::setUp();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->helper = null;
        parent::tearDown();
    }

    /**
     * Tests App_Controller_Action_Helper_Signup->signUp()
     */
    public function testSignUp()
    {
        $accountMapperMock = $this->getMock('Gnome_Model_Mapper_Db_Account', array('save'));
        $accountMapperMock->expects($this->once())->method('save');
        BowShock_Mapper_Factory::getInstance()->registerMapper($accountMapperMock, 'Gnome_Model_Mapper_Db_Account');

        $accountModel = new Gnome_Model_Account();
        $this->helper->signUp($accountModel);
    }

    /**
     * Tests App_Controller_Action_Helper_Signup->encryptPassword()
     */
    public function testEncryptPassword()
    {
        $password = $this->helper->encryptPassword('boo');
        $this->assertTrue(40 === strlen($password));
    }

    /**
     * Tests App_Controller_Action_Helper_Signup->createKey()
     */
    public function testCreateKey()
    {
        $accountMapperMock = $this->getMock('Gnome_Model_Mapper_Db_Account', array('keyExists'));
        $accountMapperMock->expects($this->once())->method('keyExists')->will($this->returnValue(false));
        BowShock_Mapper_Factory::getInstance()->registerMapper($accountMapperMock, 'Gnome_Model_Mapper_Db_Account');

        $key = $this->helper->createKey();
        $this->assertRegExp('/^[a-zA-Z]{4}-[a-zA-Z]{4}-[a-zA-Z]{4}-[a-zA-Z]{4}$/', $key);
    }

}