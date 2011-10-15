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
class Gnome_Model_Server extends BowShock_Model_Base
{

    const TYPE_PVP    = 'pvp';
    const TYPE_PVE    = 'pve';
    const TYPE_RP     = 'rp';
    const TYPE_RPPVP  = 'rppvp';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $region;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $slug;

    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return the $region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return the $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return the $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

}