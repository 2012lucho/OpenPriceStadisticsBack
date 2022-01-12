<?php
namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\Enterprice;

class PublicEnterpriceController extends PublicBaseController {

    public function actions(){
        $actions = parent::actions();
        unset( $actions['delete'],
               $actions['create'],
               $actions['update'],
               $actions['index'],
             );
  
        return $actions;
    }

    public $modelClass = 'app\models\Enterprice';

    public function actionIndex(){
        $params = Yii::$app->request->queryParams;

        $query = Enterprice::find();
        $query = $query->all();
        
        return ['items' => $query]; 
    }

}