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
class Gnome_Model_Mapper_Db_Event extends BowShock_Mapper_Db_Base
{

    /**
     * Convert model to data array
     *
     * @param  Gnome_Model_Event $model
     * @return Array
     */
    public function toArray(Gnome_Model_Event $model)
    {
        $mappedData = array(
        	'creator_id' => $model->getCreatorId(),
            'group_id' => $model->getGroupId(),
            'name' => $model->getName(),
            'start' => $model->getStart(),
            'end' => $model->getEnd(),
            'players' => $model->getPlayers(),
            'type_id' => $model->getTypeId(),
            'status_id' => $model->getStatusId()
        );

        return array_merge($mappedData, parent::toArray($model));
    }

    /**
     * Fetch all events for a group and a start time in a timeframe
     *
     * @param int|Gnome_Model_Group $group
     * @param string|Zend_Date $dateBetweenStart
     * @param string|Zend_Date $dateBetweenEnd
     */
    public function fetchEvents($group, $dateBetweenStart, $dateBetweenEnd)
    {
        if ($group instanceof Gnome_Model_Group) {
            $group = $group->getId();
        }
        if ($dateBetweenStart instanceof Zend_Date) {
            $dateBetweenStart = $dateBetweenStart->toString('YYYY-MM-d H:i:s');
        }
        if ($dateBetweenEnd instanceof Zend_Date) {
            $dateBetweenEnd = $dateBetweenEnd->toString('YYYY-MM-d H:i:s');
        }

        $select = $this->getDbTable()->select()
            ->where('group_id = ?', $group)
            ->where('start >= ?', $dateBetweenStart)
            ->where('start <= ?', $dateBetweenEnd)
            ->order('start ASC');

        $rowSet = $this->getDbTable()->fetchAll($select);

        $eventList = new App_List_Event();
        $this->buildListFromRowset($eventList, 'Gnome_Model_Event', $rowSet);

        return $eventList;
    }

}
