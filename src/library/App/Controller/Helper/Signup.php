<?php
/**
 * App
 *
 * @category   App
 * @package    Controller
 * @subpackage Helper
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Signup Controller Action Helper
 *
 * @package    Controller
 * @subpackage Helper
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class App_Controller_Helper_Signup extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Salt to encrypt password
     *
     * @var String
     */
    private $salt = 'hafDjFo';

    /**
     * @var Zend_Controller_Action_Helper_Url
     */
    private $urlHelper;

    /**
     * Signup a new account
     *
     * @param Gnome_Model_Account $accountModel
     */
    public function signUp(Gnome_Model_Account $accountModel)
    {
        $accountModel->setPassword($this->encryptPassword($accountModel->getPassword()));

        $accountMapper = BowShock_Mapper_Factory::getInstance()->getAccountMapper();
        /*@var $accountMapper Gnome_Model_Mapper_Db_Account */

        $accountModelData = $accountMapper->toArray($accountModel);
        $accountMapper->save($accountModel, $accountModelData);
    }

    /**
     * Encrypt a clear password with the configured salt
     *
     * @param  String $clearPassword
     * @return String Encrypted Password
     */
    public function encryptPassword($clearPassword)
    {
        $encrypted = sha1($clearPassword . $this->salt);

        //Trim to always 40 characters
        $encrypted = strlen($encrypted) > 40 ? substr($encrypted, 0, 40) : $encrypted;
        return $encrypted;
    }

    /**
     * Create a new and unique email authentication key
     *
     * @return String
     */
    public function createKey()
    {

        /*@var $accountMapper Gnome_Model_Mapper_Db_Account */
        $accountMapper = BowShock_Mapper_Factory::getInstance()->getAccountMapper();

        do {
            $key = $this->generateKeySection() . '-'
                 . $this->generateKeySection() . '-'
                 . $this->generateKeySection() . '-'
                 . $this->generateKeySection();
        } while ($accountMapper->keyExists($key));

        return $key;
    }

    /**
     * Verify an account
     *
     * @param String $verificationKey
     * @return Boolean Verification successfull
     */
    public function verify($verificationKey)
    {

        /*@var $accountMapper Gnome_Model_Mapper_Db_Account */
        $accountMapper = BowShock_Mapper_Factory::getInstance()->getAccountMapper();

        try {
            $account = $accountMapper->findByKey($verificationKey);
            $account->setVerified(true);

            $accountData = $accountMapper->toArray($account);
            $accountMapper->save($account, $accountData);
            return true;
        } catch (BowShock_Mapper_NotFoundException $e) {
            unset ($e);
            return false;
        }
    }

    /**
     * Generate a 4 digit key section
     *
     * @return String
     */
    private function generateKeySection()
    {
        $result = '';
        for ($i = 0; $i < 4; $i++) {
            $charIndex = rand(65, 90);
            $chr = chr($charIndex);
            $chr = rand(0, 1) == 1 ? $chr : strtolower($chr);
            $result .= $chr;
        }
        return $result;
    }

}