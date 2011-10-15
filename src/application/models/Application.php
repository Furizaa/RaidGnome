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
 * Application Model
 *
 * @package    Model
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Gnome_Model_Application extends BowShock_Model_Base
{

    /**
     * @var int
     */
    private $eventId;

    /**
     * @var int
     */
    private $charId;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var string
     */
    private $partialCome;

    /**
     * @var string
     */
    private $partialGo;

    /**
     * @return the $eventId
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * @return the $charId
     */
    public function getCharId()
    {
        return $this->charId;
    }

    /**
     * @return the $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return the $comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return the $partialCome
     */
    public function getPartialCome()
    {
        return $this->partialCome;
    }

    /**
     * @return the $partialGo
     */
    public function getPartialGo()
    {
        return $this->partialGo;
    }

    /**
     * @param int $eventId
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
    }

    /**
     * @param int $charId
     */
    public function setCharId($charId)
    {
        $this->charId = $charId;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @param string $partialCome
     */
    public function setPartialCome($partialCome)
    {
        $this->partialCome = $partialCome;
    }

    /**
     * @param string $partialGo
     */
    public function setPartialGo($partialGo)
    {
        $this->partialGo = $partialGo;
    }

}