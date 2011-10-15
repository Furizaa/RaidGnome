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
class TestGnome_Model_GroupTest extends PHPUnit_Framework_TestCase
{

    /**
     * (non-PHPdoc)
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->model = new Gnome_Model_Group();
    }

    public function tearDown()
    {

    }

    public function testSetter()
    {
        $this->model->setCreatorId(1);
        $this->model->setFaction(Gnome_Model_Group::FACTION_ALLIANCE);
        $this->model->setName("Shangri'la");
        $this->model->setServerId(1);
        $this->assertTrue(true);
        return $this->model;
    }

    /**
     * @depends testSetter
     */
    public function testGetter($model)
    {
        $this->assertSame(1, $model->getCreatorId());
        $this->assertSame(Gnome_Model_Group::FACTION_ALLIANCE, $model->getFaction());
        $this->assertSame("Shangri'la", $model->getName());
        $this->assertSame(1, $model->getServerId());
    }

}