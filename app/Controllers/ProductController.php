<?php

namespace App\Controllers;

use App\Models\ProductModel;
use Mindk\Framework\Http\Request\Request;
use Mindk\Framework\Exceptions\NotFoundException;
use Mindk\Framework\Exceptions\AuthRequiredException;

/**
 * Product controller
 *
 * Class ProductController
 * @package App\Controllers
 */
class ProductController
{
    /**
     * Products index page
     */
    function index(ProductModel $model){

        return $model->showAllProducts();

    }

    /**
     * Products index page
     */
    function vip(ProductModel $model){

        return $model->showVipProducts();

    }

    /**
     * Products sort
     */
    function sort(Request $request, ProductModel $model){

        $price = $request->get('price', '', 'string');
        $date = $request->get('date', '', 'string');

        if (!empty($price)) {
            switch ($price) {
                case 1:
                    $deskPrice = 'DESC';
                    break;
                case 2:
                    $deskPrice = 'ASC';
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
            return $model->sortPost($deskDate, $deskPrice);
        } else {
            
            if ( ($price == 1) || ($price == 2) ) {
                return $model->sortPricePost($deskPrice);
            }

            if ( ($date == 1) || ($date == 2) ) {
                return $model->sortDatePost($deskDate);
            }
        }
    }

    function upload(Request $request, ProductModel $model) {
        
		    
		$filename_doc = $_FILES; 
        return $filename_doc; die;

        
		$ext_doc = substr($filename_doc, strpos($filename_doc,'.'), strlen($filename_doc)-1); 

		if(!in_array($ext_doc,$allowed_filetypes_doc))
		die('Данный тип файла не поддерживается.');
		    
		if(filesize($_FILES['somename']['tmp_name']) > $max_filesize_doc) 
		die('Файл слишком большой.');
		    
		$path_doc = $upload_path_doc.time(void).$ext_doc;
		if(copy($_FILES['document']['tmp_name'],$path_doc)) {
		} else
            echo 'При загрузке документа возникли ошибки. Попробуйте ещё раз.';
        }

    /**
     * Single product page
     *
     * @param   ProductModel
     * @param   int Product ID
     *
     * @return  mixed
     * @throws NotFoundException
     */
    function show(ProductModel $model, $id){

        $item = $model->load($id);

        // Check if record exists
        if(empty($item)) {
            throw new NotFoundException('Product with id ' . $id . ' not found');
        }

        return $item;
    }

    /**
     * Create product
     */
    function create(Request $request, ProductModel $model){

        $token = $request->get('token', '', 'string');
        if(empty($token)) {
            throw new AuthRequiredException('token = null');
        } else {
            $user = $model->findUser($token);
            if ($user->id_role_user == "2") {
                $idUser = $user->id;
                $idCity = $request->get('idCity', '', 'string');
                $idPostCategory = $request->get('idPostCategory', '', 'string');
                $idStatus = $request->get('idStatus', '', 'string');
                $tel = $request->get('telephone', '', 'string');
                $img = $request->get('img', '', 'string');
                $text = $request->get('text', '', 'string');
                $price = $request->get('price', '', 'string');
                $title = $request->get('title', '', 'string');
                $createdAt = date("Y-m-d H:i:s");
                $updatedAt = $createdAt;

                $savePost = $model->savePost($idUser, $idCity, $idPostCategory, $idStatus, $tel, $img, $text, $price, $title, $createdAt, $updatedAt);
            } else {
                throw new AuthRequiredException('Данный пользователь не может создать объявление');
            }
        }
        if ($deletePost == true) {
            return "Запись добавлена успешно";
        }
    }

    function update(Request $request, ProductModel $model){

        $token = $request->get('token', '', 'string');
        if(empty($token)) {
            throw new AuthRequiredException('token = null'); 
        } else {
            $idPost = $request->get('idPost', '', 'string');
            $user = $model->findUser($token);

            if(empty($user)) {
                throw new AuthRequiredException('Не можем найти пользователя в базе с таким токеном'); 
            } 

            $idUser = $user->id;
            $post = $model->findPost($idUser, $idPost);

            if ((!empty($post)) || ($user->id_role_user == "1")) {
                $idCity = $request->get('idCity', '', 'string');
                $idPostCategory = $request->get('idPostCategory', '', 'string');
                $idStatus = $request->get('idStatus', '', 'string');
                $tel = $request->get('telephone', '', 'string');
                $img = $request->get('img', '', 'string');
                $text = $request->get('text', '', 'string');
                $price = $request->get('price', '', 'string');
                $title = $request->get('title', '', 'string');
                $updatedAt = date("Y-m-d H:i:s");
                
                if ($user->id_role_user == "1") {
                    $moderate = $request->get('idModerate', '', 'string');
                    $vipStatus = $request->get('idVip', '', 'string');
                } else {
                    $moderate = '0';
                }
                

                $savePost = $model->updatePost($idUser, $idCity, $idPostCategory, $idStatus, $tel, $img, $text, $price, $title, $updatedAt, $moderate, $vipStatus, $idPost);
            } else {
                throw new AuthRequiredException('Данный пользователь не может редактировать эту запись');
            }
        }
        if ($savePost == true) {
            return "Запись обновлена успешно";
        }
    }

    function delete(Request $request, ProductModel $model){

        $token = $request->get('token', '', 'string');
        if(empty($token)) {
            throw new AuthRequiredException('token = null'); 
        } else {
            $idPost = $request->get('idPost', '', 'string');
            $user = $model->findUser($token);

            if(empty($user)) {
                throw new AuthRequiredException('Не можем найти пользователя в базе с таким токеном'); 
            } 

            $idUser = $user->id;
            $post = $model->findPost($idUser, $idPost);

            if ((!empty($post)) || ($user->id_role_user == "1")) {
                $deletePost = $model->deletePost($idPost);
            } else {
                throw new AuthRequiredException('Данный пользователь не может удалить эту запись');
            }
        }
        if ($deletePost == true) {
            return "Запись удалена успешно";
        }
    }
}
