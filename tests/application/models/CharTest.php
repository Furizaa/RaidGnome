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
class TestGnome_Model_CharTest extends PHPUnit_Framework_TestCase
{

    /**
     * (non-PHPdoc)
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->model = new Gnome_Model_Char();
    }

    public function testSetter()
    {
        $this->model->setAccountId(1);
        $this->model->setClass('rogue');
        $this->model->setFaction('alliance');
        $this->model->setLevel(85);
        $this->model->setName('Fleya');
        $this->model->setRace('worgen');
        $this->model->setServerId(1);
        $this->model->setSex('female');
        $this->model->setStyleDps(true);
        $this->model->setStyleHeal(false);
        $this->model->setStyleTank(false);
        $this->model->setTreeFirst(4);
        $this->model->setTreeSecond(33);
        $this->model->setTreeThird(8);
        $this->model->setGearlevel(364);
        $this->assertTrue(true);
        return $this->model;
    }

    /**
     * @depends testSetter
     */
    public function testGetter($model)
    {
        $this->assertSame(1, $model->getAccountId());
        $this->assertSame('rogue', $model->getClass());
        $this->assertSame('alliance', $model->getFaction());
        $this->assertSame(85, $model->getLevel());
        $this->assertSame('Fleya', $model->getName());
        $this->assertSame('worgen', $model->getRace());
        $this->assertSame(1, $model->getServerId());
        $this->assertSame('female', $model->getSex());
        $this->assertTrue($model->getStyleDps());
        $this->assertFalse($model->getStyleHeal());
        $this->assertFalse($model->getStyleTank());
        $this->assertSame(4, $model->getTreeFirst());
        $this->assertSame(33, $model->getTreeSecond());
        $this->assertSame(8, $model->getTreeThird());
        $this->assertSame(364, $model->getGearlevel());
    }
}