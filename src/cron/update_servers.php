<?php

require_once 'bootstrap.php';

/**
 * CronJob to update wow server list
 *
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Gnome_Cron_UpdateServers
{

    private $regionList = array(
        BowShock_WowApi_Region::REGION_EUROPE,
        BowShock_WowApi_Region::REGION_US,
        BowShock_WowApi_Region::REGION_KOREA
    );

    public function run()
    {
        $serverApi = new Gnome_Model_Mapper_WowApi_Server();
        $serverMapper = new Gnome_Model_Mapper_Db_Server();

        foreach ($this->regionList as $region) {

            try {
                $serverApi->setRegion($region);
                $serverList = $serverApi->getList();
            } catch (Exception $e) {
                echo $e->getMessage();
                return;
            }

            $serverMapper->startTransaction();

            try {
                $serverMapper->updateFromList($serverList);
            } catch (Exception $e) {
                echo $e->getMessage();
                $serverMapper->rollbackTransaction();
                return;
            }
            $serverMapper->commitTransaction();
        }
    }

}

$cron = new Gnome_Cron_UpdateServers();
$cron->run();