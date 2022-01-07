<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property int $id
 * @property int $product_id
 * @property float $price
 * @property string $date_time
 * @property int|null $user_id
 * @property int $branch_id
 * @property int $es_oferta
 * @property float|null $porcentage_oferta
 *
 * @property Branch $branch
 * @property Products $product
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'price', 'date_time', 'branch_id', 'es_oferta'], 'required'],
            [['product_id', 'user_id', 'branch_id', 'es_oferta'], 'integer'],
            [['price', 'porcentage_oferta'], 'number'],
            [['date_time'], 'safe'],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'price' => 'Price',
            'date_time' => 'Date Time',
            'user_id' => 'User ID',
            'branch_id' => 'Branch ID',
            'es_oferta' => 'Es Oferta',
            'porcentage_oferta' => 'Porcentage Oferta',
        ];
    }

    /**
     * Gets query for [[Branch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
