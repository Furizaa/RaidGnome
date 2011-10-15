<?php
/**
 * Gnome
 *
 * @category   Gnome
 * @package    Model
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Account model
 *
 * @package    Model
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Gnome_Model_Account extends BowShock_Model_Base
{

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $uniqueKey;

    /**
     * @var boolean
     */
    private $verified;

    /**
     * @return the $email
     */
    public function getEmail ()
    {
        return $this->email;
    }

    /**
     * @return the $password
     */
    public function getPassword ()
    {
        return $this->password;
    }

    /**
     * @return the $uniqueKey
     */
    public function getUniqueKey ()
    {
        return $this->uniqueKey;
    }

    /**
     * @return the $verified
     */
    public function isVerified ()
    {
        return $this->verified;
    }

    /**
     * @param string $email
     */
    public function setEmail ($email)
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword ($password)
    {
        $this->password = $password;
    }

    /**
     * @param string $uniqueKey
     */
    public function setUniqueKey ($uniqueKey)
    {
        $this->uniqueKey = $uniqueKey;
    }
    
    /**
     * @param boolean $verified
     */
    public function setVerified ($verified)
    {
        $this->verified = $verified;
    }

}