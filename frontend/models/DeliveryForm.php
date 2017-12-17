<?php

namespace  frontend\models;

use yii\base\Model;

class DeliveryForm extends Model
{

    public $city;
    public $target;
    public $weight;
    public $price;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['weight', 'target', 'price'], 'required'],
            [['weight', 'price'], 'integer'],
            [['city'], 'safe'],
            [['weight'], 'compare', 'operator' => '>', 'compareValue' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'city'      => 'Город доставки',
            'target'     => 'Пункт выдачи заказов',
            'weight'      => 'Вес посылки в граммах',
            'price'      => 'Стоимость товара',
        ];
    }


}