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
class Gnome_Model_Mapper_Db_Char extends BowShock_Mapper_Db_Base
{

    /**
     * Convert model to data array
     *
     * @param  Gnome_Model_Char $model
     * @return Array
     */
    public function toArray(Gnome_Model_Char $model)
    {
        $mappedData = array(
            'account_id' => $model->getAccountId(),
            'server_id' => $model->getServerId(),
            'name' => $model->getName(),
            'faction' => $model->getFaction(),
            'class' => $model->getClass(),
            'race' => $model->getRace(),
            'sex' => $model->getSex(),
            'level' => $model->getLevel(),
            'tree_first' => $model->getTreeFirst(),
            'tree_second' => $model->getTreeSecond(),
            'tree_third' => $model->getTreeThird(),
            'style_tank' => $model->getStyleTank(),
            'style_heal' => $model->getStyleHeal(),
            'style_dps' => $model->getStyleDps(),
            'gearlevel' => $model->getGearlevel()
        );

        return array_merge($mappedData, parent::toArray($model));
    }

    /**
     * @param int|Gnome_Model_Account $account
     * @return App_List_Char
     */
    public function findByAccount($account)
    {
        if ($account instanceof Gnome_Model_Account) {
            $account = $account->getId();
        }

        $select = $this->getDbTable()->select()
            ->where('account_id = ?', $account);
        $rows = $this->getDbTable()->fetchAll($select);

        $list = new App_List_Char();
        $this->buildListFromRowset($list, 'Gnome_Model_Char', $rows);
        return $list;
    }

}
