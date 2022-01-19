<?php

namespace app\models;

use Yii;
use app\models\News;
use app\models\IncrementalStats;
use app\models\EnterpriceCommercialItem;
/**
 * This is the model class for table "enterprice".
 *
 * @property int $id
 * @property string $name
 *
 * @property Branch[] $branches
 * @property EnterpriceCommercialItem[] $enterpriceCommercialItems
 */
class Enterprice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enterprice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }
    public function afterSave($insert, $changedAttributes) {
        $params = Yii::$app->getRequest()->getBodyParams();
        
        //Se asocia la empresa con sus respectivos rubros
        for($c=0; $c<count($params['rubros']); $c++){
            $enterprice_rubro = new EnterpriceCommercialItem();
            $enterprice_rubro->id_commercial_item = $params['rubros'][$c]['id'];
            $enterprice_rubro->id_enterprice      = $this->id;
            $enterprice_rubro->save(false);
        }

        if ($this->isNewRecord) {
            //Se crea un nuevo registro en la tabla de novedades
            $dateTime  = new \DateTime();
            $dateTime->setTimezone(new \DateTimeZone('America/Argentina/Buenos_Aires'));
            $dateTime  = $dateTime->format('Y-m-d H:i:s');
                    
            $news = new News();
            $news->datetime = $dateTime;
            $news->text = 'Se cargó un nuevo comercio: '.$this->name;
            $news->type_id = 2;
            $news->save();

            //Se suma +1 a la cuenta de empresas registradas
            $stat = IncrementalStats::find()->where(['key' => 'cant_enterprice'])->one();
            $stat->value = $stat->value + 1;
            $stat->save(false);
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Branches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranches()
    {
        return $this->hasMany(Branch::className(), ['enterprise_id' => 'id']);
    }

    /**
     * Gets query for [[EnterpriceCommercialItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnterpriceCommercialItems()
    {
        return $this->hasMany(EnterpriceCommercialItem::className(), ['id_enterprice' => 'id']);
    }

    public function extraFields() {
        return [ 'enterpriceCommercialItems' ];
    }
}
