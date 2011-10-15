<?php

require_once 'BowShock/List.php';

/**
 * TestBowShock_ListTest test case.
 * @covers BowShock_List
 */
class TestBowShock_ListTest extends PHPUnit_Framework_TestCase
{

    /**
     * SUT
     * @var BowShock_List
     */
    private $list;

    /**
     * (non-PHPdoc)
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->list = new BowShock_List();
    }

    public function testGetIterator()
    {
        $iterator = $this->list->getIterator();
        $this->assertInstanceOf('BowShock_List_Iterator', $iterator);
    }

    public function testInitialCountIsZero()
    {
        $this->assertSame(0, count($this->list));
    }

    /**
     * @depends testInitialCountIsZero
     */
    public function testAddToList()
    {
        $this->list->add('stuff');
        $this->assertSame(1, count($this->list));
    }

    /**
     * @depends testAddToList
     */
    public function testClearList()
    {
        $this->list->add('stuff');
        $this->list->clear();
        $this->assertSame(0, count($this->list));
    }

}