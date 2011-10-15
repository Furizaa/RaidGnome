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
class TestGnome_Model_ApplicationTest extends PHPUnit_Framework_TestCase
{

    /**
     * (non-PHPdoc)
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->model = new Gnome_Model_Application();
    }

    public function testSetter()
    {
        $this->model->setCharId(1);
        $this->model->setEventId(1);
        $this->model->setComment('Comment');
        $this->model->setPartialCome('2020-01-01 15:00:00');
        $this->model->setPartialGo('2020-01-01 16:00:00');
        $this->model->setStatus('indecicive');
        $this->assertTrue(true);
        return $this->model;
    }

    /**
     * @depends testSetter
     */
    public function testGetter($model)
    {
        $this->assertSame(1, $model->getCharId());
        $this->assertSame(1, $model->getEventId());
        $this->assertSame('Comment', $model->getComment());
        $this->assertSame('2020-01-01 15:00:00', $model->getPartialCome());
        $this->assertSame('2020-01-01 16:00:00', $model->getPartialGo());
        $this->assertSame('indecicive', $model->getStatus());
    }
}