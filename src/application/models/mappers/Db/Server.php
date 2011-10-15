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
 * Server Db Mapper
 *
 * @package    ModelMapper
 * @subpackage Db
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Gnome_Model_Mapper_Db_Server extends BowShock_Mapper_Db_Base
{

	/**
     * Convert model to data array
     *
     * @param  Gnome_Model_Server $model
     * @return Array
     */
    public function toArray(Gnome_Model_Server $model)
    {
        $mappedData = array(
            'name' => $model->getName(),
            'region' => $model->getRegion(),
            'slug' => $model->getSlug(),
            'type' => $model->getType()
        );

        return array_merge($mappedData, parent::toArray($model));
    }

    /**
     * Find servers by name
     *
     * @param string $name
     * @return App_List_Server
     */
    public function findLikeName($name)
    {
        $list = new App_List_Server();
        $select = $this->getDbTable()->select()
            ->where('name LIKE ?', "$name%");
        $rows = $this->getDbTable()->fetchAll($select);

        $list = $this->buildListFromRowset($list, 'Gnome_Model_Server', $rows);

        return $list;
    }

    /**
     * Find Server by Slug and Region
     *
     * @param string $slug
     * @param string $region
     * @return Gnome_Model_Server | NULL
     */
    public function findBySlugAndRegion($slug, $region)
    {
        $select = $this->getDbTable()->select()
            ->where('slug = ?', $slug)
            ->where('region = ?', $region);

        $row = $this->getDbTable()->fetchRow($select);
        if (!is_null($row)) {
            $model = $this->buildModelFromRow(new Gnome_Model_Server(), $row);
            return $model;
        }
        return null;
    }

    /**
     * Update Database Servers from List
     *
     * @param App_List_Server $list
     */
    public function updateFromList(App_List_Server $list)
    {
        $iterator = $list->getIterator();
        while ($iterator->valid()) {
            $newModel = $iterator->current();
            $oldModel = $this->findBySlugAndRegion(
                $newModel->getSlug(),
                $newModel->getRegion()
            );
            if (!is_null($oldModel)) {
                $newModel->setOptions(array('id' => $oldModel->getId()));
            }
            $this->save($newModel, $this->toArray($newModel));
            $iterator->next();
        }
    }

}