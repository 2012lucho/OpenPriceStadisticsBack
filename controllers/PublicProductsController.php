<?php
namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\Products;

class PublicProductsController extends PublicBaseController {

    public function actions(){
        $actions = parent::actions();
        unset( $actions['delete'],
               $actions['create'],
               $actions['update'],
               $actions['index'],
             );
  
        return $actions;
    }

    public $modelClass = 'app\models\Products';

    public function actionIndex(){
        $params = Yii::$app->request->queryParams;

        $query = Products::find();
        
        if (isset($params['vendor_id'])){
            $query->where(['vendor_id' => $params['vendor_id']]);
        }

        $query = $query->all();
        
        return ['items' => $query]; 
    }
}