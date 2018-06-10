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
class CategoriesModel extends Model
{
    protected $tableName = 'post_category';
     /**
     * Get categories-list of records
     *
     * @return array
     */
    public function getListCategory() {
        $sql = 'SELECT * FROM `' . $this->tableName . '` ';       
        
        return $this->dbo->setQuery($sql)->getList(get_class($this));
    }
}