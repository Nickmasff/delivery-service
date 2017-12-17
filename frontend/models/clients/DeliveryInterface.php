<?php

namespace frontend\models\clients;


interface DeliveryInterface
{
    public function getCities();

    public function getPoints($cityCode);

    public function getCost($params);

}