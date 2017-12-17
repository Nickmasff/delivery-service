<?php

namespace frontend\models\clients;

class BoxberryClient implements DeliveryInterface
{
    const DOMAIN = 'api.boxberry.de';
    const TOKEN = '11570.pbpqebfc';
    const ERROR_MESSAGE = 'Возникла ошибка';

    public function getCities() {
        return $this->getData(['method' => 'ListCities']);
    }

    public function getPoints($cityCode) {
        return $this->getData([
            'method' => 'ListPoints',
            'CityCode' => $cityCode
        ]);
    }

    public function getCost($params) {
        return $this->getData([
            'method' => 'DeliveryCosts',
            'weight' => $params->weight,
            'target' => $params->target,
            'ordersum' => $params->price
        ]);
    }


    private function getBaseUrl()
    {
        return 'http://' . self::DOMAIN . '/json.php?token=' . self::TOKEN ;
    }

    private function getData($params)
    {
        $url = self::getBaseUrl();

        foreach ($params as $k => $v) {
            $url .=  '&' .$k . '=' . $v ;
        }
        $handle = fopen($url, "rb");
        $contents = stream_get_contents($handle);
        fclose($handle);
        $data=json_decode($contents,true);
        return $data;
    }
}