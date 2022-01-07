<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property int $id
 * @property string|null $name
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $address_road
 * @property string|null $address_number
 * @property int $enterprise_id
 *
 * @property Enterprice $enterprise
 * @property Price[] $prices
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['latitude', 'longitude'], 'number'],
            [['enterprise_id'], 'required'],
            [['enterprise_id'], 'integer'],
            [['name', 'address_road', 'address_number'], 'string', 'max' => 255],
            [['enterprise_id'], 'exist', 'skipOnError' => true, 'targetClass' => Enterprice::className(), 'targetAttribute' => ['enterprise_id' => 'id']],
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
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'address_road' => 'Address Road',
            'address_number' => 'Address Number',
            'enterprise_id' => 'Enterprise ID',
        ];
    }

    /**
     * Gets query for [[Enterprise]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnterprise()
    {
        return $this->hasOne(Enterprice::className(), ['id' => 'enterprise_id']);
    }

    /**
     * Gets query for [[Prices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Price::className(), ['branch_id' => 'id']);
    }
}
