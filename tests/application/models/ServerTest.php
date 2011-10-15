<?php
/**
 * Gnome
 *
 * @category   Gnome
 * @package    Model
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Test Case
 *
 * @package    Model
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class TestGnome_Model_ServerTest extends PHPUnit_Framework_TestCase
{

    /**
     * (non-PHPdoc)
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->model = new Gnome_Model_Server();
    }

    public function testSetter()
    {
        $this->model->setName("Gul'dan");
        $this->model->setRegion(BowShock_WowApi_Region::REGION_EUROPE);
        $this->model->setType(Gnome_Model_server::TYPE_RP);
        $this->model->setSlug('guldan');
        $this->assertTrue(true);
        return $this->model;
    }

    /**
     * @depends testSetter
     */
    public function testGetter($model)
    {
        $this->assertSame("Gul'dan", $model->getName());
        $this->assertSame(BowShock_WowApi_Region::REGION_EUROPE, $model->getRegion());
        $this->assertSame(Gnome_Model_Server::TYPE_RP, $model->getType());
        $this->assertSame("guldan", $model->getSlug());
    }

}