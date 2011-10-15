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
 * Character Model
 *
 * @package    Model
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Gnome_Model_Char extends BowShock_Model_Base
{

    /**
     * @var int
     */
    private $accountId;

    /**
     * @var int
     */
    private $serverId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $faction;

    /**
     * @var string
     */
    private $class;

    /**
     * @var string
     */
    private $race;

    /**
     * @var string
     */
    private $sex;

    /**
     * @var int
     */
    private $level;

    /**
     * @var int
     */
    private $treeFirst;

    /**
     * @var int
     */
    private $treeSecond;

    /**
     * @var int
     */
    private $treeThird;

    /**
     * @var boolean
     */
    private $styleTank;

    /**
     * @var boolean
     */
    private $styleHeal;

    /**
     * @var boolean
     */
    private $styleDps;

    /**
     * @var int
     */
    private $gearlevel;

    /**
     * @return the $accountId
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @return the $serverId
     */
    public function getServerId()
    {
        return $this->serverId;
    }

    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return the $faction
     */
    public function getFaction()
    {
        return $this->faction;
    }

    /**
     * @return the $class
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @return the $race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @return the $sex
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @return the $level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return the $treeFirst
     */
    public function getTreeFirst()
    {
        return $this->treeFirst;
    }

    /**
     * @return the $treeSecond
     */
    public function getTreeSecond()
    {
        return $this->treeSecond;
    }

    /**
     * @return the $treeThird
     */
    public function getTreeThird()
    {
        return $this->treeThird;
    }

    /**
     * @return the $styleTank
     */
    public function getStyleTank()
    {
        return $this->styleTank;
    }

    /**
     * @return the $styleHeal
     */
    public function getStyleHeal()
    {
        return $this->styleHeal;
    }

    /**
     * @return the $styleDps
     */
    public function getStyleDps()
    {
        return $this->styleDps;
    }

    /**
     * @param int $accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * @param int $serverId
     */
    public function setServerId($serverId)
    {
        $this->serverId = $serverId;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $faction
     */
    public function setFaction($faction)
    {
        $this->faction = $faction;
    }

    /**
     * @param string $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @param string $race
     */
    public function setRace($race)
    {
        $this->race = $race;
    }

    /**
     * @param string $sex
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    /**
     * @param int $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @param int $treeFirst
     */
    public function setTreeFirst($treeFirst)
    {
        $this->treeFirst = $treeFirst;
    }

    /**
     * @param int $treeSecond
     */
    public function setTreeSecond($treeSecond)
    {
        $this->treeSecond = $treeSecond;
    }

    /**
     * @param int $treeThird
     */
    public function setTreeThird($treeThird)
    {
        $this->treeThird = $treeThird;
    }

    /**
     * @param boolean $styleTank
     */
    public function setStyleTank($styleTank)
    {
        $this->styleTank = $styleTank;
    }

    /**
     * @param boolean $styleHeal
     */
    public function setStyleHeal($styleHeal)
    {
        $this->styleHeal = $styleHeal;
    }

    /**
     * @param boolean $styleDps
     */
    public function setStyleDps($styleDps)
    {
        $this->styleDps = $styleDps;
    }

    /**
     * @return the $gearlevel
     */
    public function getGearlevel()
    {
        return $this->gearlevel;
    }

    /**
     * @param int $gearlevel
     */
    public function setGearlevel($gearlevel)
    {
        $this->gearlevel = $gearlevel;
    }

}