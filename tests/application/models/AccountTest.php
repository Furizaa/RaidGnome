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
class TestGnome_Model_AccountTest extends PHPUnit_Framework_TestCase
{

    /**
     * (non-PHPdoc)
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->model = new Gnome_Model_Account();
    }

    public function tearDown()
    {

    }

    public function testSetter()
    {
        $this->model->setEmail('test@test.de');
        $this->model->setPassword('test');
        $this->model->setUniqueKey('12345');
        $this->model->setVerified(true);
        $this->assertTrue(true);
        return $this->model;
    }

    /**
     * @depends testSetter
     */
    public function testGetter($model)
    {
        $this->assertSame('test@test.de', $model->getEmail());
        $this->assertSame('test', $model->getPassword());
        $this->assertSame('12345', $model->getUniqueKey());
        $this->assertTrue($model->isVerified());
    }

}