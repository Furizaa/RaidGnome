<?php
/**
 * BowShock
 *
 * @category   BowShock
 * @package
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

require_once 'BowShock/List/Iterator.php';

/**
 * List
 *
 * @package
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class BowShock_List implements IteratorAggregate, Countable
{

    /**
     * @var array
     */
    private $data = array();

    /**
     * (non-PHPdoc)
     * @see IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        return new BowShock_List_Iterator($this->data);
    }

    /**
     * (non-PHPdoc)
     * @see Countable::count()
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * Add Value to List
     *
     * @param mixed $value
     */
    public function add($value)
    {
        $this->data[] = $value;
    }

    /**
     * Clear complete list data
     */
    public function clear()
    {
        $this->data = array();
    }

}