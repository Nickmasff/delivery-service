<?php
namespace frontend\controllers;

use frontend\models\clients\BoxberryClient;
use frontend\models\DeliveryForm;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use frontend\models\clients\DeliveryInterface;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{

    private $deliveryService;

    public function __construct($id, $module, DeliveryInterface $deliveryService, $config = [])
    {
        $this->deliveryService = $deliveryService;
        parent::__construct($id, $module, $config);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $deliveryForm = new DeliveryForm();

        return $this->render('index', [
            'deliveryService'=>$this->deliveryService,
            'deliveryForm' => $deliveryForm
        ]);
    }

    public function actionGetPoints($cityCode)
    {
        if(Yii::$app->request->isAjax) {

            \Yii::$app->response->format = Response::FORMAT_JSON;

            $points =  ArrayHelper::map($this->deliveryService->getPoints($cityCode),
                'Code', 'Name' );

            return $points;
        }

        throw new NotFoundHttpException();
    }

    public function actionGetPrice()
    {

        if(Yii::$app->request->isAjax) {

            $deliveryForm = new DeliveryForm();

            if($deliveryForm->load(Yii::$app->request->post()) && $deliveryForm->validate())
            {
                $price =  $this->deliveryService->getCost($deliveryForm);

                if(array_key_exists('price', $price)) {
                    return 'Стоимость составит ' . $price['price'] . ' р.';
                }
            }

            return BoxberryClient::ERROR_MESSAGE;
        }

        throw new NotFoundHttpException();
    }


}
