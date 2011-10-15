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
class Gnome_Model_Group extends BowShock_Model_Base
{

    const FACTION_ALLIANCE = 'alliance';
    const FACTION_HORDE    = 'horde';

    const ACCOUNT_STATUS_REQUEST  = 'request';
    const ACCOUNT_STATUS_MEMBER   = 'member';
    const ACCOUNT_STATUS_BANNED   = 'banned';
    const ACCOUNT_STATUS_REJECTED = 'rejected';

    /**
     * @var integer
     */
    private $serverId;

    /**
     * @var integer
     */
    private $creatorId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $faction;

    /**
     * @return the $serverId
     */
    public function getServerId()
    {
        return $this->serverId;
    }

    /**
     * @return the $creatorId
     */
    public function getCreatorId()
    {
        return $this->creatorId;
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
     * @param integer $serverId
     */
    public function setServerId($serverId)
    {
        $this->serverId = $serverId;
    }

    /**
     * @param integer $creatorId
     */
    public function setCreatorId($creatorId)
    {
        $this->creatorId = $creatorId;
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

}