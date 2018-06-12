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
    protected $moderated = 'moderate';
    protected $vips = 'vip';
    protected $true = '1';
    protected $count = 'id';

    public function countPosts($isVip, $categories, $cities, $data, $deskPrice, $deskDate) {
        $sql = sprintf("SELECT count(`id`) FROM `%s` WHERE `%s`='%s' AND `%s` IN (%s)
        AND `id_post_category` IN (%s) AND `id_city` IN (%s)
        AND (`text` LIKE '%%%s%%' OR `title` LIKE '%%%s%%' OR `price` LIKE '%%%s%%')
        ORDER BY `price` %s, `updated_at` %s", 
        $this->tableName, $this->moderated, $this->true, $this->vips, $isVip,
        $categories, $cities, 
        $data, $data, $data,
        $deskPrice, $deskDate);

        return $this->dbo->setQuery($sql)->getArray($this);
    }

    public function sortPost($isVip, $categories, $cities, $data, $deskDate, $deskPrice, $start, $num) {
        $sql = sprintf("SELECT * FROM `%s` WHERE `%s`='%s' AND `%s` IN (%s)
            AND `id_post_category` IN (%s) AND `id_city` IN (%s)
            AND (`text` LIKE '%%%s%%' OR `title` LIKE '%%%s%%' OR `price` LIKE '%%%s%%')
            ORDER BY `updated_at` %s, `price` %s LIMIT  %s, %s", 
            $this->tableName, $this->moderated, $this->true, $this->vips, $isVip,
            $categories, $cities, 
            $data, $data, $data,
            $deskPrice, $deskDate, $start, $num);
        
        return $this->dbo->setQuery($sql)->getList(get_class($this));
    }
}
