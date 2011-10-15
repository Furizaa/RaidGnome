<?php
/**
 * App
 *
 * @category   App
 * @package    List
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Group List
 *
 * @package    List
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class App_List_Event extends BowShock_List
{

    /**
     * @see   BowShock_List::add()
     * @param Gnome_Model_Event $event
     */
    public function add(Gnome_Model_Event $event)
    {
        parent::add($event);
    }

}