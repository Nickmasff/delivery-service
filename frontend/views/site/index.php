<?php

/* @var $this yii\web\View */
/* @var $cities array */
/* @var $deliveryForm \frontend\models\DeliveryForm */
/* @var $deliveryService \frontend\models\clients\DeliveryInterface */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = Yii::$app->name;
$cities = ArrayHelper::map($deliveryService->getCities(), 'Code', 'Name');
natcasesort($cities);
?>


<?php $form = ActiveForm::begin(['id' => 'delivery-form']); ?>


<?= $form->field($deliveryForm, 'city')->dropDownList(
        $cities, ['prompt' => '...'])?>

<?= $form->field($deliveryForm, 'target')->dropDownList([],['disabled' => 'disabled'])?>

<?= $form->field($deliveryForm, 'price') ?>

<?= $form->field($deliveryForm, 'weight') ?>

<div class="delivery_response">

</div>

<div class="form-group">
    <?= Html::submitButton('Рассчитать стоимость', ['class' => 'btn btn-primary', 'name' => 'delivery-button']) ?>
</div>

<?php ActiveForm::end(); ?>












