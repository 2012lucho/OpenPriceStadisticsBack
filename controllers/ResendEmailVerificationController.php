<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;

use app\modules\v1\models\User;



class ResendEmailVerificationController extends BaseController {

    public $modelClass = 'app\models\User';

    public function actions(){
        $actions = parent::actions();
        $actions['update']['class'] = 'app\actions\ResendEmailVerificationAction';
        return $actions;
    } 
      
    public function actionIndex() {
       return new ActiveDataProvider([
         'query' => User::find(),
       ]);
    }

}