<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $id_user
 * @property string $date_order
 * @property int $status_order
 * @property string $updated_at
 *
 * @property GoodsInOrders[] $goodsInOrders
 */
class Orders extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'updated_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => (new \DateTime())->format('Y-m-d H:i:s'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'status_order'], 'integer'],
            [['date_order', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'date_order' => 'Date Order',
            'status_order' => 'Status Order',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoodsInOrders()
    {
        return $this->hasMany(GoodsInOrders::className(), ['order_id' => 'id']);
    }

    


}
