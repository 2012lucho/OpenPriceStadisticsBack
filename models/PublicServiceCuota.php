<?php

namespace app\models;

use Yii;
use app\models\PublicServiceCoutaMeter;

/**
 * This is the model class for table "public_service_couta".
 *
 * @property int $id
 * @property int $id_cuota_meter
 * @property int $id_public_service
 *
 * @property PublicServiceCoutaMeter $cuotaMeter
 * @property PublicService $publicService
 */
class PublicServiceCuota extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public_service_couta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cuota_meter', 'id_public_service'], 'required'],
            [['id_cuota_meter', 'id_public_service'], 'integer'],
            [['id_cuota_meter'], 'exist', 'skipOnError' => true, 'targetClass' => PublicServiceCoutaMeter::className(), 'targetAttribute' => ['id_cuota_meter' => 'id']],
            [['id_public_service'], 'exist', 'skipOnError' => true, 'targetClass' => PublicService::className(), 'targetAttribute' => ['id_public_service' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_cuota_meter' => 'Id Cuota Meter',
            'id_public_service' => 'Id Public Service',
        ];
    }

    /**
     * Gets query for [[CuotaMeter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCuotaMeter()
    {
        return $this->hasOne(PublicServiceCuotaMeter::className(), ['id' => 'id_cuota_meter']);
    }

    /**
     * Gets query for [[PublicService]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicService()
    {
        return $this->hasOne(PublicService::className(), ['id' => 'id_public_service']);
    }
}
