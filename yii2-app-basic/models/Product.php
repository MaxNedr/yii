<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $price
 * @property int $created_at
 */
class Product extends \yii\db\ActiveRecord
{
    CONST SCENARIO_CREATE = 'create';
    CONST SCENARIO_UPDATE = 'update';

    public function scenarios() {

        return [
            self::SCENARIO_DEFAULT => ['name', 'price', 'created_at'],
            self::SCENARIO_CREATE => ['name', 'price', 'created_at'],
            self::SCENARIO_UPDATE => ['price', 'created_at'],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'created_at'], 'required'],
            [['created_at'], 'integer'],
            [['price'], 'integer', 'max' => 1000, 'min'=>0],

            [['name'], 'string', 'max' => 20, 'min'=>2],
            ['name', 'filter', 'filter' => function ($string) {
                return trim(strip_tags($string));
            }],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'created_at' => 'Created At',
        ];
    }
}
