<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;

use app\modules\v1\models\Profile;


class ProfileController extends BaseController {

    public $modelClass = 'app\models\Profile';

    public function actionIndex() {
       return new ActiveDataProvider([
         'query' => User::find(),
       ]);
    }

}
