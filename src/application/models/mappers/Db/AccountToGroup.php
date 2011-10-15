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
 * Account/Group Cross Table mapper
 *
 * @package    ModelMapper
 * @subpackage Db
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Gnome_Model_Mapper_Db_AccountToGroup extends BowShock_Mapper_Db_CrossTable
{

    /**
     * Add account to group
     *
     * @param Gnome_Model_Account|int $account
     * @param Gnome_Model_Group|int $group
     * @throws BowShock_Mapper_ConstraintException
     */
    public function addAccountToGroup($account, $group)
    {
        if ($account instanceof Gnome_Model_Account) {
            $account = $account->getId();
        }
        if ($group instanceof Gnome_Model_Group) {
            $group = $group->getId();
        }

        $data = array(
            'created_at' => date('Y-m-d H:i:s'),
            'account_id' => $account,
            'group_id'   => $group
        );

        try {
            $this->getDbTable()->insert($data);
        // @codeCoverageIgnoreStart
        } catch (Exception $e) {
            throw new BowShock_Mapper_ConstraintException(
                'Error adding account to group: '
                . $e->getMessage()
            );
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * Remove account from group
     *
     * @param Gnome_Model_Account|int $account
     * @param Gnome_Model_Group|int $group
     */
    public function removeAccountFromGroup($account, $group)
    {
        if ($account instanceof Gnome_Model_Account) {
            $account = $account->getId();
        }
        if ($group instanceof Gnome_Model_Group) {
            $group = $group->getId();
        }

        $rowsAffected = $this->getDbTable()->delete(array(
            'account_id = ?' => $account,
            'group_id = ?' => $group
        ));

        if (0 === $rowsAffected) {
            throw new BowShock_Mapper_NotFoundException(
                "Delete: Relation Group '$group' to "
                . "Account '$account' not found!"
            );
        }
    }

    /**
     * Set Account to Group status
     *
     * @param Gnome_Model_Account|int $account
     * @param Gnome_Model_Group|int $group
     * @param string $status
     */
    public function setStatus($account, $group, $status)
    {
        if ($account instanceof Gnome_Model_Account) {
            $account = $account->getId();
        }
        if ($group instanceof Gnome_Model_Group) {
            $group = $group->getId();
        }

        $data = array(
            'status' => $status
        );
        $where = array(
            'account_id = ?' => $account,
            'group_id = ?' => $group
        );

        $rowsAffected = $this->getDbTable()->update($data, $where);
        if (0 === $rowsAffected) {
            throw new BowShock_Mapper_NotFoundException(
                "Update: Relation Group '$group' to "
                . "Account '$account' not found!"
            );
        }
    }

}