<?php
/**
 * Gnome
 *
 * @category   Gnome
 * @package    Plugins
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Test Case
 *
 * @package    Plugins
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Gnome_Plugins_LayoutTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Gnome_Plugin_Layout
     */
    private $plugin;

    /**
     * @var Zend_Controller_Request_Http
     */
    private $request;

    /**
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->plugin = new Gnome_Plugin_Layout();
        $this->request = new Zend_Controller_Request_Http();
        $this->layout = $this->getMock('Zend_Layout');
        $this->plugin->setLayout($this->layout);
    }

    public function testLayoutEnabledByDefault()
    {
        $this->layout->expects($this->exactly(0))->method('disableLayout');
        $result = $this->plugin->preDispatch($this->request);
        $this->assertFalse($result);
    }

    public function testLayoutEnabledForNonHttpRequests()
    {
        $this->layout->expects($this->exactly(0))->method('disableLayout');
        $result = $this->plugin->preDispatch(new Zend_Controller_Request_Simple());
        $this->assertFalse($result);
    }

    public function testLayoutDisabledForPart()
    {
        $this->request->setRequestUri('bogus/foobar.part');
        $this->layout->expects($this->exactly(1))->method('disableLayout');
        $result = $this->plugin->preDispatch($this->request);
        $this->assertTrue($result);
    }

    public function testLayoutDisabledForAsync()
    {
        $this->request->setRequestUri('bogus/foobar.async');
        $this->layout->expects($this->exactly(1))->method('disableLayout');
        $result = $this->plugin->preDispatch($this->request);
        $this->assertTrue($result);
    }

}