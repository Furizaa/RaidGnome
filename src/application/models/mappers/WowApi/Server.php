<?php
/**
 * Gnome
 *
 * @category   Gnome
 * @package    ModelMapper
 * @subpackage WowApi
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Server WowApi Mapper
 *
 * @package    ModelMapper
 * @subpackage WowApi
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Gnome_Model_Mapper_WowApi_Server extends BowShock_Mapper_WowApi_Base
{

    /**
     * @var string
     */
    protected $method = 'realm/status';

    /**
     * Get complete server list for region
     *
     * @return App_List_Server
     */
    public function getList()
    {
        $serverArray = $this->call();
        $serverArray = $serverArray['realms'];

        $list = new App_List_Server();
        foreach ($serverArray as $serverData) {
            $serverData['region'] = $this->getRegion();
            $model = new Gnome_Model_Server();
            $model->setOptions($serverData);
            $list->add($model);
        }

        return $list;
    }

}