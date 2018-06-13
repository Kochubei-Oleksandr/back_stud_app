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
class ProductModel extends Model
{
    protected $tableName = 'users';
    protected $tablePost = 'post';
    /* protected $moder = 'moderate'; */
    /* protected $vips = 'vip'; */
    /* protected $true = '1'; */
    /* protected $count = 'id'; */

    /* public function showVipPosts($count) {
        $sql = sprintf("SELECT * FROM `%s` WHERE `%s`='%s' AND `%s`='%s' ORDER BY `updated_at` DESC LIMIT %s", 
        $this->tablePost, $this->moder, $this->true, $this->vips, $this->true, $count);

        return $this->dbo->setQuery($sql)->getList(get_class($this));
    } */

    public function loadPosts ($idUser) {
        $sql = sprintf("SELECT * FROM `%s` WHERE `id_user`='%s'", $this->tablePost, $idUser);

        return $this->dbo->setQuery($sql)->getList(get_class($this));
    }

    public function showPost($id) {
        $sql = sprintf("SELECT * FROM `%s` WHERE `%s`='%s' AND `%s`='%s' ", 
        $this->tablePost, $this->moder, $this->true, $this->count, $id);

        return $this->dbo->setQuery($sql)->getList(get_class($this));
    }

    /* public function countPosts() {
        $sql = sprintf("SELECT count(`%s`) FROM `%s` WHERE `%s`='%s' LIMIT 1", $this->count, $this->tablePost, $this->moder, $this->true);

        return $this->dbo->setQuery($sql)->getArray($this);
    } */

    public function savePost($idUser, $idCity, $idPostCategory, $idStatus, $tel, $img, $text, $price, $title, $createdAt, $updatedAt){
        $sql = sprintf("INSERT INTO `%s` (`id_user`,`id_city`,`id_post_category`,`id_status`,`telephone`,`img`,`text`,`price`,`title`,`created_at`,`updated_at`) VALUES
            ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')", $this->tablePost, $idUser, $idCity, $idPostCategory, $idStatus, $tel, $img, $text, $price, $title, $createdAt, $updatedAt);
        return $this->dbo->setQuery($sql)->getSuccessStatement($this);
    }
    
    public function findPost($idUser, $idPost) {
        $sql = sprintf("SELECT * FROM `%s` WHERE `id_user`='%s' AND `id`='%s'", $this->tablePost, $idUser, $idPost);
        return $this->dbo->setQuery($sql)->getResult($this);
    }

    public function updatePost($idCity, $idPostCategory, $idStatus, $tel, $img, $text, $price, $title, $updatedAt, $moderate, $vipStatus, $idPost){
        $sql = sprintf("UPDATE `%s` SET `id_city`='%s',`id_post_category`='%s',`id_status`='%s',`telephone`='%s',`img`='%s',`text`='%s',`price`='%s',`title`='%s',`updated_at`='%s', `moderate`='%s', `vip`='%s'
        WHERE `id`= '%s'", $this->tablePost, $idCity, $idPostCategory, $idStatus, $tel, $img, $text, $price, $title, $updatedAt, $moderate, $vipStatus, $idPost);
        
        return $this->dbo->setQuery($sql)->getSuccessStatement($this);
    }

    public function deletePost($idPost) {
        $sql = sprintf("DELETE FROM `%s` WHERE `id`='%s'", $this->tablePost, $idPost);
        return $this->dbo->setQuery($sql)->getSuccessStatement($this);
    }
}