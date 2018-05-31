<?php

namespace App\Controllers;

use App\Models\CategoriesModel;
use Mindk\Framework\Http\Request\Request;
use Mindk\Framework\Exceptions\NotFoundException;

/**
 * Product controller
 *
 * Class ProductController
 * @package App\Controllers
 */
class CategoriesController
{
    /**
     * Show list Categories
     */
    function show(CategoriesModel $model){

        return $model->getListCategory();

    }
}
