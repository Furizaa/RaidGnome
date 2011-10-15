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
class App_Controller_Helper_RecoveryTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    /**
     * @var App_Controller_Helper_Recovery
     */
    private $helper;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        BowShock_Mapper_Factory::getInstance()->setMapperNamespace('Gnome_Model_Mapper_Db');
        $this->helper = new App_Controller_Helper_Recovery();
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
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

    public function testPasswordGeneration()
    {
        $password = $this->helper->generatePassword('does.not.exist@raidgnome.com');
        $this->assertRegExp('/^[a-zA-Z]{8}$/', $password);
    }

}