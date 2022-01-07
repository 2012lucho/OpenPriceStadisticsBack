<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vendor".
 *
 * @property int $id
 * @property string $name
 * @property int|null $root_vendor_id
 *
 * @property Products[] $products
 * @property Vendor $rootVendor
 * @property Vendor[] $vendors
 */
class Vendor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['root_vendor_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['root_vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vendor::className(), 'targetAttribute' => ['root_vendor_id' => 'id']],
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
            'root_vendor_id' => 'Root Vendor ID',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['vendor_id' => 'id']);
    }

    /**
     * Gets query for [[RootVendor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRootVendor()
    {
        return $this->hasOne(Vendor::className(), ['id' => 'root_vendor_id']);
    }

    /**
     * Gets query for [[Vendors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVendors()
    {
        return $this->hasMany(Vendor::className(), ['root_vendor_id' => 'id']);
    }
}
