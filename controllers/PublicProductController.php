<?php
namespace app\controllers;

use yii\rest\ActiveController;


class PublicProductsController extends PublicProductController {

    public function actions(){
        $actions = parent::actions();
        unset( $actions['delete'],
               $actions['create'],
               $actions['update'],
             );
  
        return $actions;
    }

    public $modelClass = 'app\models\Products';

}