<?php
namespace backend\models;

use common\components\exception\NoGoodsException;
use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property int $id
 * @property string $name
 * @property string $short_description
 * @property string $full_description
 * @property int $category_id
 * @property string $price
 * @property int $count_available
 * @property int $status
 * @property int $active
 * @property string $country
 * @property string $updated_at
 *
 * @property GoodsInOrders[] $goodsInOrders
 */
class Goods extends \yii\db\ActiveRecord
{

    const ACTIVE = 1;
    const INACTIVE = 0;

    const STATUS_AVAILABLE = 1;
    const STATUS_FOR_ORDER = 2;
    const STATUS_UNAVAILABLE = 3;
    const STATUS_OLD = 4;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goods';
    }

    public function humanNamesStatuses(){
        return
            [
                self::STATUS_AVAILABLE => 'Available',
                self::STATUS_FOR_ORDER => 'For order',
                self::STATUS_UNAVAILABLE => 'Unavailable',
                self::STATUS_OLD => 'Old',
            ][$this->status];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'count_available', 'status', 'active'], 'integer'],
            [['price'], 'number'],
            [['updated_at'], 'safe'],
            [['name'], 'string', 'max' => 60],
            [['short_description'], 'string', 'max' => 255],
            [['full_description'], 'string', 'max' => 2000],
            [['info'], 'string', 'max' => 1000],
            [['country'], 'string', 'max' => 50],
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
            'short_description' => 'Short Description',
            'full_description' => 'Full Description',
            'category_id' => 'Category ID',
            'price' => 'Price',
            'count_available' => 'Count Available',
            'status' => 'Status',
            'active' => 'Active',
            'country' => 'Country',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getGoods()
    {
        return self::find();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     * @throws NoGoodsException
     */
    public static function getActiveGoods()
    {
        $goods = self::getGoods()->where(['active' => self::ACTIVE])->all();
        if (!$goods) {
            throw new NoGoodsException();
        }

        return $goods;
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     * @throws NoGoodsException
     */
    public static function getInactiveGoods()
    {
        $goods = self::getGoods()->where(['active' => self::INACTIVE])->all();

        return $goods;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoodsInOrders()
    {
        return $this->hasMany(GoodsInOrders::className(), ['good_id' => 'id']);
    }
}
