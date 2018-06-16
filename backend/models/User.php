<?php

namespace backend\models;

use Yii;
use backend\models\GoodsInOrders;
/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $way_payment
 * @property int $way_supply
 * @property string $address
 * @property string $phone
 * @property string $temp_order_id
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at', 'way_payment', 'way_supply'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 190],
            [['phone'], 'string', 'max' => 60],
            [['auth_key', 'temp_order_id'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function afterSave($insert, $changedAttributes){
        parent::afterSave($insert, $changedAttributes);
        if($insert){
            if($this->temp_order_id){ //if exists temp order ID, then we will add new order
//add new orders and goodsInOrders Rows
                /** @var Array
                 * [
                 *  'goods' => [
                 *          0 => [
                 *                  'good_id' => 100,
                 *                  'count_goods' => 2
                 *             ]
                 *      ]
                 * ]
                 * $ordersInfo */
                $ordersInfo = unserialize(\Yii::$app->session->readSession($this->temp_order_id))['goods'];
                $order = new Orders();
                $order->id_user = $this->id;
                $order->date_order = (new \DateTime())->format('Y-m-d H:i:s');
                $order->updated_at = (new \DateTime())->format('Y-m-d H:i:s');
                $order->status_order = Orders::STATUS_JUST_ORDERED;
                $order->save();

                foreach($ordersInfo as $good){
                    $goodInOrders = new GoodsInOrders();
                    $goodInOrders->good_id = $good['good_id'];
                    $goodInOrders->count_goods = $good['count_goods'];
                    $goodInOrders->order_id = $order->id; //todo get OrderId from afterSave method or from session
                    $goodInOrders->save();

                }
            }
        }else{
            //find exists rows and chang it
        }
        //... тут ваш код
    }
}
