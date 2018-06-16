<?php
/**
 * Created by PhpStorm.
 * User: ivansamofal
 * Date: 6/2/18
 * Time: 2:40 PM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Orders;
use common\models\User;


/*
price
good name



user address
user way payment
user way supply
phone
email


table guests

create guest after fubmit form and in model guests/users on method aftersave we are creating from session data instanses
of the goods_in_orders table

create in session array with some rand key and
foreach($_SESSION['some_unique_guest_id']['goods] as $good){
    $goodInOrders = new GoodInOrders();
    $goodInOrders->good_id = $good->id;
    $goodInOrders->order_id = $orderId; //todo get OrderId from afterSave method or from session
    

}


*/

$newUserModel = new User;
$order->id_user = \Yii::$app->user->id ? : 0;
$order->status_order = Orders::STATUS_ACTIVE;

$form = ActiveForm::begin([
    'id' => 'order-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<?= $form->field($newUserModel, 'username') ?>
<?= $form->field($newUserModel, 'email') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Вход', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>