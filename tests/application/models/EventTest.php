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
class TestGnome_Model_EventTest extends PHPUnit_Framework_TestCase
{

    /**
     * (non-PHPdoc)
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->model = new Gnome_Model_Event();
    }

    public function testSetter()
    {
        $this->model->setCreatorId(1);
        $this->model->setEnd('2020-01-01 12:00:00');
        $this->model->setGroupId(1);
        $this->model->setName('Blackwing Lair Retro');
        $this->model->setPlayers(25);
        $this->model->setStart('2020-01-01 08:00:00');
        $this->model->setTypeId(1);
        $this->model->setStatusId(5);
        $this->assertTrue(true);
        return $this->model;
    }

    /**
     * @depends testSetter
     */
    public function testGetter(Gnome_Model_Event $model)
    {
        $this->assertSame(1, $model->getCreatorId());
        $this->assertSame('2020-01-01 12:00:00', $model->getEnd());
        $this->assertSame(1, $model->getGroupId());
        $this->assertSame('Blackwing Lair Retro', $model->getName());
        $this->assertSame(25, $model->getPlayers());
        $this->assertSame('2020-01-01 08:00:00', $model->getStart());
        $this->assertSame(1, $model->getTypeId());
        $this->assertSame(5, $model->getStatusId());
    }
}