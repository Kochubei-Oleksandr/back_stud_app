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
                $createdAt = date("Y-m-d H:i:s");
                $updatedAt = $createdAt;
                $moderate = '0';

                $savePost = $model->updatePost($idUser, $idCity, $idPostCategory, $idStatus, $tel, $img, $text, $price, $title, $createdAt, $updatedAt, $moderate, $idPost);
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
