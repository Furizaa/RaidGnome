<?php
/**
 * BowShock
 *
 * @category   BowShock
 * @package    Route
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Test Case
 *
 * @package    Route
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class BowShock_Route_AjaxResourceTest extends PHPUnit_Framework_TestCase
{

    private $config = array(
        'default' => array(
            'controller' => 'error',
            'action' => 'error'
        ),
        'route' => 'dialog/(.*)-(.*)\.part',
        'reverse' => 'dialog/%s-%s.part',
        'map' => array(
            1 => 'controller',
            2 => 'action'
        )
    );

    /**
     * (non-PHPdoc)
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $config = new Zend_Config($this->config);
        $this->route = Zend_Controller_Router_Route_Regex::getInstance($config);
    }

    public function testMatch()
    {
        $result = $this->route->match('dialog/index-load.part');
        $this->assertSame('index', $result['controller']);
        $this->assertSame('load', $result['action']);
    }

    public function testMatchFail()
    {
        $result = $this->route->match('dialog/load-index.json');
        $this->assertFalse($result);
    }

    public function testAssemble()
    {
        $data = array(
            'controller' => 'account',
            'action' => 'create'
        );

        $result = $this->route->assemble($data);
        $this->assertSame('dialog/account-create.part', $result);
    }

}