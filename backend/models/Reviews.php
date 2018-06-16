<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property int $user_id
 * @property string $text_review
 * @property string $date_review
 * @property int $rate_review
 * @property string $updated_at
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'rate_review'], 'integer'],
            [['date_review', 'updated_at'], 'safe'],
            [['text_review'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'text_review' => 'Text Review',
            'date_review' => 'Date Review',
            'rate_review' => 'Rate Review',
            'updated_at' => 'Updated At',
        ];
    }
}
