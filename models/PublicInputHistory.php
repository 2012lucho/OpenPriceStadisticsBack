<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "public_input_history".
 *
 * @property int $id
 * @property string $client_ip4
 * @property string $client_ip6
 * @property string $cookie_session
 * @property string $datetime
 */
class PublicInputHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public_input_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_ip4', 'client_ip6', 'cookie_session', 'datetime'], 'required'],
            [['cookie_session'], 'string'],
            [['datetime'], 'safe'],
            [['client_ip4', 'client_ip6'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_ip4' => 'Client Ip4',
            'client_ip6' => 'Client Ip6',
            'cookie_session' => 'Cookie Session',
            'datetime' => 'Datetime',
        ];
    }
}
