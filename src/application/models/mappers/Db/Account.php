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
class Gnome_Model_Mapper_Db_Account extends BowShock_Mapper_Db_Base
{

    /**
     * Convert model to data array
     *
     * @param  Gnome_Model_Account $model
     * @return Array
     */
    public function toArray(Gnome_Model_Account $model)
    {
        $mappedData = array('email' => $model->getEmail(),
                            'password' => $model->getPassword(),
                            'unique_key' => $model->getUniqueKey(),
                            'verified' => $model->isVerified());

        return array_merge($mappedData, parent::toArray($model));
    }

    /**
     * Check if key exists in the database
     *
     * @param  String $key
     * @return Boolean
     */
    public function keyExists($key)
    {
        try {
            $this->findByKey($key);
            return true;
        } catch (BowShock_Mapper_NotFoundException $e) {
            unset($e);
            return false;
        }
    }

    /**
     * Find account by key
     * Fill found record into newly created or provided model
     *
     * @param String $key
     * @param Gnome_Model_Account | NULL $model
     * @return Gnome_Model_Account
     * @throws BowShock_Mapper_NotFoundException
     */
    public function findByKey($key, Gnome_Model_Account $model = NULL)
    {
        $select = $this->getDbTable()->select()
            ->where('unique_key = ?', $key)
            ->limit(1);

        $row = $this->getDbTable()->fetchRow($select);

        if (is_null($row)) {
            throw new BowShock_Mapper_NotFoundException(
                sprintf('Account by mail %s not found', $key)
            );
        }

        if (is_null($model)) {
            $model = new Gnome_Model_Account();
        }
        return $this->buildModelFromRow($model, $row);
    }

    /**
     * Find account by email
     * Fill found record into newly created or provided model
     *
     * @param String $email
     * @param Gnome_Model_Account $model = NULL
     * @throws BowShock_Mapper_NotFoundException
     */
    public function findByMail($email, Gnome_Model_Account $model = NULL)
    {
        $select = $this->getDbTable()->select()
            ->where('email = ?', $email);

        $row = $this->getDbTable()->fetchRow($select);
        if (is_null($row)) {
            throw new BowShock_Mapper_NotFoundException(
                sprintf('Account by mail %s not found', $email)
            );
        }

        if (is_null($model)) {
            $model = new Gnome_Model_Account();
        }
        return $this->buildModelFromRow($model, $row);
    }

}
