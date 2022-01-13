<?php
namespace app\controllers;

use yii\rest\ActiveController;

class PublicEnterpriceCommercialItemController extends PublicBaseController {

    public function actions(){
        $actions = parent::actions();
        unset( $actions['delete'],
               $actions['create'],
               $actions['update'],
             );
  
        return $actions;
    }

    public $modelClass = 'app\models\EnterpriceCommercialItem';

}