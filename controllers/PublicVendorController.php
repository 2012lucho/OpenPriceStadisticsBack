<?php
namespace app\controllers;

use Yii;
use yii\rest\ActiveController;

use app\models\Vendor;

class PublicVendorController extends PublicBaseController {

    public function actions(){
        $actions = parent::actions();
        unset( $actions['delete'],
               $actions['create'],
               $actions['update'],
               $actions['index'],
             );
  
        return $actions;
    }

    public $modelClass = 'app\models\Vendor';

    public function actionIndex(){
        $params = Yii::$app->request->queryParams;

        $query = Vendor::find();
        
        $query = $query->all();
        
        return ['items' => $query]; 
    }
}