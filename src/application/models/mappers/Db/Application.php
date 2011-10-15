<?php
/**
 * Gnome
 *
 * @category   Gnome
 * @package    ModelMapper
 * @subpackage Db
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Account Db Mapper
 *
 * @package    ModelMapper
 * @subpackage Db
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Gnome_Model_Mapper_Db_Application extends BowShock_Mapper_Db_Base
{

    /**
     * Convert model to data array
     *
     * @param  Gnome_Model_Application $model
     * @return Array
     */
    public function toArray(Gnome_Model_Application $model)
    {
        $mappedData = array(
            'event_id' => $model->getEventId(),
            'char_id' => $model->getCharId(),
            'status' => $model->getStatus(),
            'comment' => $model->getComment(),
            'partial_come' => $model->getPartialCome(),
            'partial_go' => $model->getPartialGo()
        );

        return array_merge($mappedData, parent::toArray($model));
    }

    /**
     * Save Application Model
     *
     * Save provided model to database. Always create a new record
     * for an application.
     *
     * @param  Gnome_Model_Application $model
     * @param  array		           $data
     * @return void
     */
    public function save(Gnome_Model_Application $model, array $data)
    {
        $model->setOptions(array('id' => null));
        return parent::save($model, $data);
    }

    /**
     * @param int|Gnome_Model_Event $event
     * @return App_List_Application
     */
    public function fetchForEvent($event)
    {
        if ($event instanceof Gnome_Model_Event) {
            $event = $event->getId();
        }

        $select = $this->getDbTable()->select()
            ->where('event_id = ?', $event);
        $rowset = $this->getDbTable()->fetchAll($select);
        $list = new App_List_Application();
        $this->buildListFromRowset($list, 'Gnome_Model_Application', $rowset);
        return $list;
    }

}
