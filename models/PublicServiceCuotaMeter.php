<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "public_service_couta_meter".
 *
 * @property int $id
 * @property string $cod
 * @property string $description
 * @property int $time_lapse_seconds
 * @property int $amount
 *
 * @property PublicServiceCouta[] $publicServiceCoutas
 */
class PublicServiceCuotaMeter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public_service_couta_meter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cod', 'description', 'time_lapse_seconds', 'amount'], 'required'],
            [['time_lapse_seconds', 'amount'], 'integer'],
            [['cod', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cod' => 'Cod',
            'description' => 'Description',
            'time_lapse_seconds' => 'Time Lapse Seconds',
            'amount' => 'Amount',
        ];
    }

    /**
     * Gets query for [[PublicServiceCoutas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicServiceCoutas()
    {
        return $this->hasMany(PublicServiceCouta::className(), ['id_cuota_meter' => 'id']);
    }
}
