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
    protected $tableName = 'post';
    protected $tableUser = 'users';
    protected $moder = 'moderate';
    protected $vip = 'vip';
    protected $true = 'true';


    /**
     * Get list of records
     *
     * @return array
     */
    public function showAllProducts() {
        $sql = 'SELECT * FROM `' . $this->tableName . '` WHERE `'.$this->moder.'` = ' . $this->true . ' ';

        return $this->dbo->setQuery($sql)->getList(get_class($this));
    }

    /**
     * Get vip-list of records
     *
     * @return array
     */
    public function showVipProducts() {
        $sql = 'SELECT * FROM `' . $this->tableName . '` WHERE `'.$this->vip.'` = ' . $this->true . ' 
            AND `'.$this->moder.'` = ' . $this->true . ' ';       
        
        return $this->dbo->setQuery($sql)->getList(get_class($this));
    }

    public function findUser($token) {
        $sql = sprintf("SELECT * FROM `%s` WHERE `token`='%s'", $this->tableUser, $token);

        return $this->dbo->setQuery($sql)->getResult($this);
    }

    public function savePost($idUser, $idCity, $idPostCategory, $idStatus, $tel, $img, $text, $price, $title, $createdAt, $updatedAt){
        $sql = sprintf("INSERT INTO `%s` (`id_user`,`id_city`,`id_post_category`,`id_status`,`telephone`,`img`,`text`,`price`,`title`,`created_at`,`updated_at`) VALUES
            ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')", $this->tableName, $idUser, $idCity, $idPostCategory, $idStatus, $tel, $img, $text, $price, $title, $createdAt, $updatedAt);
        return $this->dbo->setQuery($sql)->getSuccessStatement($this);
    }
}