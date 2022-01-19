<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commercial_item".
 *
 * @property int $id
 * @property string $name
 * @property string|null $icon
 *
 * @property EnterpriceCommercialItem[] $enterpriceCommercialItems
 */
class EnterpriceItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'commercial_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'icon'], 'string', 'max' => 255],
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
            'icon' => 'Icon',
        ];
    }

    /**
     * Gets query for [[EnterpriceCommercialItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnterpriceCommercialItems()
    {
        return $this->hasMany(EnterpriceCommercialItem::className(), ['id_commercial_item' => 'id']);
    }
}
