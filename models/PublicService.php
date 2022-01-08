<?php

namespace app\models;
use app\models\PublicServiceCoutaMeter;

use Yii;

/**
 * This is the model class for table "public_service".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @property PublicInputHistory[] $publicInputHistories
 */
class PublicService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['name', 'description'], 'string', 'max' => 255],
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
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[PublicInputHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicInputHistories()
    {
        return $this->hasMany(PublicInputHistory::className(), ['public_service_id' => 'id']);
    }
}
