<?php
/**
 * Gnome
 *
 * @category   Gnome
 * @package    ModelDbTable
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Db Table
 *
 * @package    ModelDbTable
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Gnome_Model_DbTable_Char extends BowShock_Db_Table
{

    /**
     * @var string
     */
    protected $_primary = 'id';

    /**
     * @var string
     */
    public static $tableName = 'char';

}