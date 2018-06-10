<?php

namespace App\Models;

use Mindk\Framework\DB\DBOConnectorInterface;
use Mindk\Framework\DI\Service;
use Mindk\Framework\Models\Model;

/**
 * Class ProductModel
 *
 * @package App\Models
 */
class CityModel extends Model
{
    protected $tableNameRegion = 'region';

    public function getListCity() {

        $sql = 'SELECT * , `city`.`city` AS `city` 
        FROM `region` 
        INNER JOIN `city` ON `city`.`id_region` = `region`.`id` ';       
        
        return $this->dbo->setQuery($sql)->getList(get_class($this));
    }

    public function getListRegion() {

        $sql = 'SELECT * FROM `' . $this->tableNameRegion . '` ';

        return $this->dbo->setQuery($sql)->getList(get_class($this));
    }
}