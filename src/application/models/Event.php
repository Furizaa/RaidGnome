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
 * Event Model
 *
 * @package    Model
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Gnome_Model_Event extends BowShock_Model_Base
{

    /**
     * @var int
     */
    private $groupId;

    /**
     * @var int
     */
    private $creatorId;

    /**
     * @var int
     */
    private $typeId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $players;

    /**
     * @var string
     */
    private $start;

    /**
     * @var string
     */
    private $end;

    /**
     * @var int
     */
    private $statusId;

    /**
     * @return the $groupId
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @return the $creatorId
     */
    public function getCreatorId()
    {
        return $this->creatorId;
    }

    /**
     * @return the $typeId
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return the $players
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @return the $start
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return the $end
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param int $groupId
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }

    /**
     * @param int $creatorId
     */
    public function setCreatorId($creatorId)
    {
        $this->creatorId = $creatorId;
    }

    /**
     * @param int $typeId
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param int $players
     */
    public function setPlayers($players)
    {
        $this->players = $players;
    }

    /**
     * @param string $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @param string $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }

    /**
     * @return the $statusId
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * @param int $statusId
     */
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;
    }
}