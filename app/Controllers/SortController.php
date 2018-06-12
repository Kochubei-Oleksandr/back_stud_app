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

        $deskDate = 'DESC';
        $deskPrice = 'ASC';

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

        $urlPath = $request->get('path', '', 'string');
        $isVip = "";
        if (!empty($urlPath)) {
            if (preg_match("/products\/\d+/", $urlPath)) {
                $isVip = "0,1";
            } else {
                $isVip = "1";
            }
        }

        $categories = $request->get('categories', '', 'something');
        if (!empty($categories)) {
            $categories = implode(",", $categories);
        } else {
            $categories = "SELECT `id_post_category` FROM `post`";
        }
        
        $cities = $request->get('cities', '', 'something');
        if (!empty($cities)) {
            $cities = implode(",", $cities);
        } else {
            $cities = "SELECT `id_city` FROM `post`";
        }

        $data = $request->get('data', '', 'string');
        if (empty($data)) {
            $data = NULL;
        }

        $page = $request->get('page', '', 'string');
        $num = '18';

        $posts = $model->countPosts($isVip, $categories, $cities, $data, $deskPrice, $deskDate);
        $posts = $posts['0'];

        // Находим общее число страниц 
        $total = intval(($posts - 1) / $num) + 1; 

        // Определяем начало сообщений для текущей страницы 
        $page = intval($page); 

        // Если значение $page меньше единицы или отрицательно 
        // переходим на первую страницу 
        // А если слишком большое, то переходим на последнюю 
        if(empty($page) or $page < 0) $page = 1; 
        if($page > $total) $page = $total; 

        // Вычисляем начиная к какого номера 
        // следует выводить сообщения 
        $start = $page * $num - $num;

        $data = $model->sortPost($isVip, $categories, $cities, $data, $deskPrice, $deskDate, $start, $num);

        return [
            'count_post' => $total,
            'data' => $data
        ];
    }
}
