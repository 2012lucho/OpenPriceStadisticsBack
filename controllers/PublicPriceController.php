<?php
namespace app\controllers;

use yii\rest\ActiveController;


class PublicPriceController extends PublicBaseController {

    public function actions(){
        $actions = parent::actions();
        unset( $actions['delete'],
               $actions['update'],
             );
  
        return $actions;
    }

    public $modelClass = 'app\models\Price';

}