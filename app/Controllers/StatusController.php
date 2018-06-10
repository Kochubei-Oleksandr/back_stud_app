<?php

namespace App\Controllers;

use App\Models\StatusModel;
use Mindk\Framework\Http\Request\Request;
use Mindk\Framework\Exceptions\NotFoundException;

/**
 * Product controller
 *
 * Class ProductController
 * @package App\Controllers
 */
class StatusController
{
    /**
     * Show list Status
     */
    function showStatus(StatusModel $model){

        return $model->getListStatus();

    }
}
