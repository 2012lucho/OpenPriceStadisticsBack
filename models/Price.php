<?php

namespace app\models;

use Yii;
use app\models\News;
use app\models\IncrementalStats;
/**
 * This is the model class for table "price".
 *
 * @property int $id
 * @property int $product_id
 * @property float $price
 * @property string $date_time
 * @property int|null $user_id
 * @property int $branch_id
 * @property int $es_oferta
 * @property float|null $porcentage_oferta
 *
 * @property Branch $branch
 * @property Products $product
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'price', 'date_time', 'branch_id', 'es_oferta'], 'required'],
            [['product_id', 'user_id', 'branch_id', 'es_oferta'], 'integer'],
            [['price', 'porcentage_oferta'], 'number'],
            [['date_time'], 'safe'],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'price' => 'Price',
            'date_time' => 'Date Time',
            'user_id' => 'User ID',
            'branch_id' => 'Branch ID',
            'es_oferta' => 'Es Oferta',
            'porcentage_oferta' => 'Porcentage Oferta',
        ];
    }

    public function beforeSave($insert) {
        //Se crea un nuevo registro en la tabla de novedades
        $dateTime  = new \DateTime();
        $dateTime->setTimezone(new \DateTimeZone('America/Argentina/Buenos_Aires'));
        $dateTime  = $dateTime->format('Y-m-d H:i:s');
                
        $news = new News();
        $news->datetime = $dateTime;
        $news->text = 'Se cargó un nuevo precio; Producto: '.$this->products->name.' - Precio: $ '.$this->price.' - Comercio: '.$this->branch->name;
        $news->type_id = 1;
        $news->save();

        //Se suma +1 a la cuenta de precios registrados
        $stat = IncrementalStats::find()->where(['key' => 'cant_price'])->one();
        $stat->value = $stat->value + 1;
        $stat->save(false);
        return parent::beforeSave($insert);
    }

    /**
     * Gets query for [[Branch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    public function extraFields() {
        return [ 'products', 'branch' ];
    }

    public function fields() {
        $fields = parent::fields();

        $fields['products'] = function(){
          return $this->products;
        };

        $fields['branch'] = function() {
          return $this->branch;
        };

        return $fields;
    }
}
