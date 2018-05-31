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
    /* protected $sortStatusOne = 'vip';
    protected $sortStatusTwo = 'moderate';
    protected $param = 'true'; */
}