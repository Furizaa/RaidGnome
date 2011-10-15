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
class Gnome_Model_Mapper_Db_Group extends BowShock_Mapper_Db_Base
{

    /**
     * Convert model to data array
     *
     * @param  Gnome_Model_Group $model
     * @return Array
     */
    public function toArray(Gnome_Model_Group $model)
    {
        $mappedData = array('faction' => $model->getFaction(),
                            'name'    => $model->getName(),
                            'server_id' => $model->getServerId(),
                            'creator_id' => $model->getCreatorId());

        return array_merge($mappedData, parent::toArray($model));
    }

    /**
     * Find groups by name
     *
     * @param string $name
     * @return App_List_Group
     */
    public function findLikeName($name)
    {
        $list = new App_List_Group();
        $select = $this->getDbTable()->select()
            ->where('name LIKE ?', "$name%");
        $rows = $this->getDbTable()->fetchAll($select);

        $list = $this->buildListFromRowset($list, 'Gnome_Model_Group', $rows);

        return $list;
    }

    /**
     * Find groups created by account id
     *
     * @param integer $creatorAccountId
     * @return App_List_Group
     */
    public function findByCreator($creatorAccountId)
    {
        $list = new App_List_Group();
        $select = $this->getDbTable()->select()
            ->where('creator_id = ?', $creatorAccountId);
        $rows = $this->getDbTable()->fetchAll($select);

        $list = $this->buildListFromRowset($list, 'Gnome_Model_Group', $rows);

        return $list;
    }

    /**
     * Find group list attached to an account
     *
     * @param Gnome_Model_Account|int $account
     */
    public function findByAccount($account)
    {
        if ($account instanceof Gnome_Model_Account) {
            $account = $account->getId();
        }
        $select = $this->getDbTable()->select()->setIntegrityCheck(false)
            ->joinLeft(
                Gnome_Model_DbTable_AccountToGroup::$tableName,
                Gnome_Model_DbTable_Group::$tableName . '.id = '
                . Gnome_Model_DbTable_AccountToGroup::$tableName . '.group_id'
            )
            ->joinLeft(
                Gnome_Model_DbTable_Account::$tableName,
                Gnome_Model_DbTable_AccountToGroup::$tableName . '.account_id = '
                . Gnome_Model_DbTable_Account::$tableName . '.id'
            )
            ->where(Gnome_Model_DbTable_Account::$tableName . '.id = ?', $account);
        $rows = $this->getDbTable()->fetchAll($select);

        $list = new App_List_Group();
        $list = $this->buildListFromRowset($list, 'Gnome_Model_Group', $rows);

        return $list;
    }

}
