<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "enterprice_commercial_item".
 *
 * @property int $id
 * @property int $id_enterprice
 * @property int $id_commercial_item
 *
 * @property Enterprice $enterprice
 * @property CommercialItem $commercialItem
 */
class EnterpriceCommercialItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enterprice_commercial_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_enterprice', 'id_commercial_item'], 'required'],
            [['id_enterprice', 'id_commercial_item'], 'integer'],
            [['id_enterprice'], 'exist', 'skipOnError' => true, 'targetClass' => Enterprice::className(), 'targetAttribute' => ['id_enterprice' => 'id']],
            [['id_commercial_item'], 'exist', 'skipOnError' => true, 'targetClass' => CommercialItem::className(), 'targetAttribute' => ['id_commercial_item' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_enterprice' => 'Id Enterprice',
            'id_commercial_item' => 'Id Commercial Item',
        ];
    }

    /**
     * Gets query for [[Enterprice]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnterprice()
    {
        return $this->hasOne(Enterprice::className(), ['id' => 'id_enterprice']);
    }

    /**
     * Gets query for [[CommercialItem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommercialItem()
    {
        return $this->hasOne(CommercialItem::className(), ['id' => 'id_commercial_item']);
    }

    public function extraFields() {
        return [ 'commercialItem', 'enterprice' ];
    }
}
