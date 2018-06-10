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
class SortModel extends Model
{
    protected $tableName = 'post';


    public function sortPost($deskPrice, $deskDate) {
        $sql = sprintf("SELECT * FROM `%s` ORDER BY `price` %s, `updated_at` %s", $this->tableName, $deskPrice, $deskDate);
        return $this->dbo->setQuery($sql)->getList(get_class($this));
    }

    public function sortDatePost($deskDate) {
        $sql = sprintf("SELECT * FROM `%s` ORDER BY `updated_at` %s ", $this->tableName, $deskDate);
        return $this->dbo->setQuery($sql)->getList(get_class($this));
    }
    public function sortPricePost($deskPrice) {
        $sql = sprintf("SELECT * FROM `%s` ORDER BY `price` %s ", $this->tableName, $deskPrice);
        return $this->dbo->setQuery($sql)->getList(get_class($this));
    }

    public function sortAllPost($categories, $cities) {
        $sql = sprintf("SELECT * FROM `%s` WHERE `id_post_category` IN (%s) AND `id_city` IN (%s) ", $this->tableName, $categories, $cities);
        
        return $this->dbo->setQuery($sql)->getList(get_class($this));
    }

    public function sortCategoryPost($categories) {
        $sql = sprintf("SELECT * FROM `%s` WHERE `id_post_category` IN (%s) ", $this->tableName, $categories);
        
        return $this->dbo->setQuery($sql)->getList(get_class($this));
    }

    public function sortCityPost($cities) {
        $sql = sprintf("SELECT * FROM `%s` WHERE `id_city` IN (%s) ", $this->tableName, $cities);
        
        return $this->dbo->setQuery($sql)->getList(get_class($this));
    }

    public function searchPost($data) {
        $sql = sprintf("SELECT * FROM `%s` WHERE `text` LIKE '%%%s%%'
        OR `title` LIKE '%%%s%%' OR `price` LIKE '%%%s%%' ", $this->tableName, $data, $data, $data);
        
        return $this->dbo->setQuery($sql)->getList(get_class($this));
    }
}