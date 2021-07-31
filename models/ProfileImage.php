<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile_image".
 *
 * @property int $id
 * @property string $path
 * @property string $url
 * @property int|null $profile_id
 *
 * @property Profile[] $profiles
 * @property Profile $profile
 */
class ProfileImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path', 'url'], 'required'],
            [['profile_id'], 'integer'],
            [['path', 'url'], 'string', 'max' => 400],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'url'  => 'Url',
            'profile_id' => 'Profile ID',
        ];
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['default_profile_image_id' => 'id'])->inverseOf('defaultProfileImage');
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id'])->inverseOf('profileImages');
    }
}
