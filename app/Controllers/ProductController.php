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
     * Single product page
     *
     * @param   ProductModel
     * @param   int Product ID
     *
     * @return  mixed
     * @throws NotFoundException
     */
    function show(ProductModel $model, $id){

        $item = $model->showPost($id);

        // Check if record exists
        if(empty($item)) {
            throw new NotFoundException('Product with id ' . $id . ' not found');
        }

        return $item;
    }

    function showMyPosts(Request $request, ProductModel $model){

        $token = $request->get('token', '', 'string');
        if(empty($token)) {
            throw new AuthRequiredException('token = null'); 
        } else {
            $user = $model->findByToken($token);

            if(empty($user)) {
                throw new AuthRequiredException('Не можем найти пользователя в базе с таким токеном'); 
            } 

            $idUser = $user->id;

            return $model->loadPosts($idUser);
        }
    }

    /**
     * Create product
     */
    function create(Request $request, ProductModel $model){

        $token = $request->get('token', '', 'string');
        if(empty($token)) {
            throw new AuthRequiredException('token = null');
        } else {
            $user = $model->findByToken($token);
            if ($user->id_role_user == "2") {
                $idUser = $user->id;
                $idCity = $request->get('idCity', '', 'string');
                $idPostCategory = $request->get('idPostCategory', '', 'string');
                $idStatus = $request->get('idStatus', '', 'string');
                $tel = $request->get('telephone', '', 'string');
                
                $imgName = $request->get('img', '', 'string');
                $ext = substr($imgName, strpos($imgName,'.'), strlen($imgName)-1);
                $imgCleanName = basename($imgName, $ext);
                
                $img = '/static/img/'.$imgCleanName.'-'.time().$ext;

                $text = $request->get('text', '', 'string');
                $price = $request->get('price', '', 'string');
                $title = $request->get('title', '', 'string');
                $createdAt = date("Y-m-d");
                $updatedAt = $createdAt;

                $savePost = $model->savePost($idUser, $idCity, $idPostCategory, $idStatus, $tel, $img, $text, $price, $title, $createdAt, $updatedAt);

                if (!empty($_FILES)) {
                    $allowed_filetypes = array('.jpg','.jpeg','.gif','.bmp','.png'); 
                    $max_filesize = 5242880;  
                    $filename = $_FILES['fupload']['name']; 
                    $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
                    $imgCleanName = basename($filename, $ext);
                    
                    $path = '../../frontend/static/img/';
                    $pathFull = $path.$imgCleanName.'-'.time().$ext;
                        
                    if(!in_array($ext,$allowed_filetypes)) {
                        return ('Данный тип файла не поддерживается.');
                    }
                    
                    if(($_FILES['fupload']['size']) > $max_filesize) {
                        return ('Файл слишком большой.');
                    }

                    $addPhoto = copy($_FILES['fupload']['tmp_name'], $pathFull);
                    
                    if($addPhoto == false) {
                        return 'При загрузке фото возникли ошибки =/';
                    }
                }

            } else {
                throw new AuthRequiredException('Данный пользователь не может создать объявление');
            }
        }
        if ($savePost == true) {
            return "Запись добавлена успешно";
        }
    }
    
    /**
     * После редактирования поста сбрасываем ВИП и модерацию
     */
    function update(Request $request, ProductModel $model){

        $token = $request->get('token', '', 'string');
        if(empty($token)) {
            throw new AuthRequiredException('token = null'); 
        } else {
            $idPost = $request->get('idPost', '', 'string');
            $user = $model->findByToken($token);

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

                $imgName = $request->get('img', '', 'string');
                $ext = substr($imgName, strpos($imgName,'.'), strlen($imgName)-1);
                $imgCleanName = basename($imgName, $ext);
                
                $img = '/static/img/'.$imgCleanName.'-'.time().$ext;

                $text = $request->get('text', '', 'string');
                $price = $request->get('price', '', 'string');
                $title = $request->get('title', '', 'string');
                $updatedAt = date("Y-m-d");
                
                if ($user->id_role_user == "1") {
                    $moderate = $request->get('idModerate', '', 'string');
                    $vipStatus = $request->get('idVip', '', 'string');
                } else {
                    $moderate = '0';
                    $vipStatus = '0';
                }

                $updatePost = $model->updatePost($idCity, $idPostCategory, $idStatus, $tel, $img, $text, $price, $title, $updatedAt, $moderate, $vipStatus, $idPost);

                if (!empty($_FILES)) {
                    $allowed_filetypes = array('.jpg','.jpeg','.gif','.bmp','.png'); 
                    $max_filesize = 5242880;  
                    $filename = $_FILES['fupload']['name']; 
                    $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
                    $imgCleanName = basename($filename, $ext);
                    
                    $path = '../../frontend/static/img/';
                    $pathFull = $path.$imgCleanName.'-'.time().$ext;
                        
                    if(!in_array($ext,$allowed_filetypes)) {
                        return ('Данный тип файла не поддерживается.');
                    }
                    
                    if(($_FILES['fupload']['size']) > $max_filesize) {
                        return ('Файл слишком большой.');
                    }

                    unlink('../../frontend'.$post->img);
                    $addPhoto = copy($_FILES['fupload']['tmp_name'], $pathFull);
                    
                    if($addPhoto == false) {
                        return 'При загрузке фото возникли ошибки =/';
                    }
                }
                
            } else {
                throw new AuthRequiredException('Данный пользователь не может редактировать эту запись');
            }
        }
        if ($updatePost == true) {
            return "Запись обновлена успешно";
        }
    }

    function delete(Request $request, ProductModel $model){

        $token = $request->get('token', '', 'string');
        if(empty($token)) {
            throw new AuthRequiredException('token = null'); 
        } else {
            $idPost = $request->get('idPost', '', 'string');
            $user = $model->findByToken($token);

            if(empty($user)) {
                throw new AuthRequiredException('Не можем найти пользователя в базе с таким токеном'); 
            } 

            $idUser = $user->id;
            $post = $model->findPost($idUser, $idPost);

            if ((!empty($post)) || ($user->id_role_user == "1")) {
                $path = '../../frontend';
                unlink($path.$post->img);
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
