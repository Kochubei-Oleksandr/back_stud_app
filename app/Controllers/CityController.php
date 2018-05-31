<?php

namespace App\Controllers;

use App\Models\CityModel;
use Mindk\Framework\Http\Request\Request;
use Mindk\Framework\Exceptions\NotFoundException;

/**
 * City controller
 *
 * Class CityController
 * @package App\Controllers
 */
class CityController
{
    /**
     * Show list Categories
     */
    function show(CityModel $model){

        return $model->getListCity();

    }
}