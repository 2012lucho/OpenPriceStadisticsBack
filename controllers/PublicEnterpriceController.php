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
             );
  
        return $actions;
    }

    public $modelClass = 'app\models\Enterprice';

}