<?php
namespace app\controllers;

use yii\rest\ActiveController;


class ProfileImageController extends BaseController {

    public $modelClass = 'app\models\ProfileImage';

    public function actions(){
        $actions = parent::actions();
        unset( $actions['update'],
               $actions['index'],
               $actions['view']
             );
             
        $actions['create']['class'] = 'app\actions\CreateImageAction';
        $actions['delete']['class'] = 'app\actions\DeleteImageAction';
        return $actions;
    }
}
