<?php

namespace App\Controllers;

use App\Models\SortModel;
use Mindk\Framework\Http\Request\Request;
use Mindk\Framework\Exceptions\NotFoundException;
use Mindk\Framework\Exceptions\AuthRequiredException;

/**
 * Product controller
 *
 * Class ProductController
 * @package App\Controllers
 */
class SortController
{

    /**
     * Products sort
     */
    function sort(Request $request, SortModel $model){

        $price = $request->get('price', '', 'string');
        $date = $request->get('date', '', 'string');

        if (!empty($price)) {
            switch ($price) {
                case 1:
                    $deskPrice = 'DESC';//от большего к меньшему
                    break;
                case 2:
                    $deskPrice = 'ASC';//от меньшего к большему
                    break;
            }
        }
        if (!empty($date)) {
            switch ($date) {
                case 1:
                    $deskDate = 'DESC';
                    break;
                case 2:
                    $deskDate = 'ASC';
                    break;
            }
        }

        if ( (!empty($price)) && (!empty($date)) ) {
            return $model->sortPost($deskPrice, $deskDate);
        } else {
    
            if ( ($price == 1) || ($price == 2) ) {
                return $model->sortPricePost($deskPrice);
            }

            if ( ($date == 1) || ($date == 2) ) {
                return $model->sortDatePost($deskDate);
            }
        }
    }

    function sortCategory(Request $request, SortModel $model){

        $categories = $request->get('categories', '', 'something');
        $categories = implode(",", $categories);

        $cities = $request->get('cities', '', 'something');
        $cities = implode(",", $cities);

        if ( (!empty($categories)) && (!empty($cities)) ) {
            return $model->sortAllPost($categories, $cities);
        } else {
            if (!empty($categories)){
                return $model->sortCategoryPost($categories);
            }
            if (!empty($cities)){
                return $model->sortCityPost($cities);
            }
        } 
    }

    function search(Request $request, SortModel $model){

        $data = $request->get('data', '', 'string');

        return $model->searchPost($data);
    }
}
