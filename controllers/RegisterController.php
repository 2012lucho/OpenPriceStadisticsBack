<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\Cors;


class RegisterController extends ActiveController {

    public $modelClass = 'app\models\User';

    public function actions(){
        $actions = parent::actions();
        unset( $actions['delete'],
               $actions['update'],
               $actions['index'],
               $actions['view']
             );
  
        $actions['create']['class'] = 'app\actions\UserAction';
        return $actions;
  
      }
  
      public function behaviors() {
          $behaviors = parent::behaviors();
          $behaviors['corsFilter'] = [
             'class' => Cors::className(),
             'cors' => [
                   'Origin' => ['*'],
                   'Access-Control-Request-Method' => ['POST', 'HEAD', 'OPTIONS'],
                   'Access-Control-Request-Headers' => ['*'],
                   'Access-Control-Allow-Credentials' => null,
                   'Access-Control-Max-Age' => 0,
                   'Access-Control-Expose-Headers' => [],
               ]
          ];
          return $behaviors;
      }

}