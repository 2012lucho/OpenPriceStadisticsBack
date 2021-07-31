<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string|null $birth_date
 * @property string|null $description
 * @property string|null $email
 * @property int|null $gender_id
 * @property int $gender_preference_id
 * @property int|null $default_profile_image_id
 * @property float|null $lat
 * @property float|null $lng
 *
 * @property ProfileImage $defaultProfileImage
 * @property Gender $gender
 * @property Gender $genderPreference
 * @property ProfileImage[] $profileImages
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gender_id', 'gender_preference_id', 'default_profile_image_id'], 'integer'],
            [['gender_preference_id'], 'required'],
            [['birth_date'], 'string', 'max' => 15],
            [['description', 'email'], 'string', 'max' => 255],
            [['default_profile_image_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProfileImage::className(), 'targetAttribute' => ['default_profile_image_id' => 'id']],
            [['gender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gender::className(), 'targetAttribute' => ['gender_id' => 'id']],
            [['gender_preference_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gender::className(), 'targetAttribute' => ['gender_preference_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'birth_date' => 'Birth Date',
            'description' => 'Description',
            'email' => 'Email',
            'gender_id' => 'Gender ID',
            'gender_preference_id' => 'Gender Preference ID',
            'default_profile_image_id' => 'Default Profile Image ID',
            'lat' => 'Latitud',
            'lng' => 'Longitud',
        ];
    }

    /**
     * Gets query for [[DefaultProfileImage]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultProfileImage()
    {
        return $this->hasOne(ProfileImage::className(), ['id' => 'default_profile_image_id'])->inverseOf('profiles');
    }

    /**
     * Gets query for [[Gender]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne(Gender::className(), ['id' => 'gender_id'])->inverseOf('profiles');
    }

    /**
     * Gets query for [[GenderPreference]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenderPreference()
    {
        return $this->hasOne(Gender::className(), ['id' => 'gender_preference_id'])->inverseOf('profiles0');
    }

    /**
     * Gets query for [[ProfileImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfileImages()
    {
        return $this->hasMany(ProfileImage::className(), ['profile_id' => 'id'])->inverseOf('profile');
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfile()
    {
        return $this->hasOne(User::className(), ['profile_id' => 'id'])->inverseOf('userProfile');
    }

    public function extraFields() {
        return [
                  'profileImages',
                  'defaultProfileImage',
                  'genderPreference',
                  'gender'
               ];
    }
}
