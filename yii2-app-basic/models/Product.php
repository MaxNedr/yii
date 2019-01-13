<?php

namespace app\models;

use yii\base\Model;

/**
 * Class Product
 * @package app\models
 * int $id
 * int $price
 * string $name
 * string $category
 *
 */
class Product extends Model
{
    public $name;
    public $id;
    public $category;
    public $price;

}
