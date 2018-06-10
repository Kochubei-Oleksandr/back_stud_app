<?php

namespace App\Models;

use Mindk\Framework\DB\DBOConnectorInterface;
use Mindk\Framework\DI\Service;
use Mindk\Framework\Models\Model;

/**
 * Class StatusModel
 *
 * @package App\Models
 */
class StatusModel extends Model
{
    protected $tableName = 'status';
     /**
     * Get categories-list of records
     *
     * @return array
     */
    public function getListStatus() {
        $sql = 'SELECT * FROM `' . $this->tableName . '` ';       
        
        return $this->dbo->setQuery($sql)->getList(get_class($this));
    }
}