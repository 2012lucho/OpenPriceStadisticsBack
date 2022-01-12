<?php
namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\News;

class PublicNewsController extends PublicBaseController {

    public function actions(){
        $actions = parent::actions();
        unset( $actions['delete'],
               $actions['create'],
               $actions['update'],
               $actions['index'],
             );
  
        return $actions;
    }

    public $modelClass = 'app\models\News';

    public function actionIndex(){
        $params = Yii::$app->request->queryParams;

        $query = News::find();
        
        $query = $query->orderBy(['datetime' => SORT_DESC])->limit(50)->all();
        
        return ['items' => $query]; 
    }
}