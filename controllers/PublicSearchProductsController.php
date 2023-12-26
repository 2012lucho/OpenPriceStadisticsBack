<?php 
namespace app\controllers; 

use Yii; 
use yii\web\Controller;
use yii\filters\Cors;

use app\models\Price;

class PublicSearchProductsController extends Controller { 
    
    public function behaviors() {
        $behaviors = parent::behaviors();
        
        $behaviors['corsFilter'] = [
           'class' => Cors::className(),
           'cors' => [
                 'Origin' => ['*'],
                 'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                 'Access-Control-Request-Headers' => ['*'],
                 'Access-Control-Allow-Credentials' => null,
                 'Access-Control-Max-Age' => 0,
                 'Access-Control-Expose-Headers' => [],
             ]
        ];
        return $behaviors;
    }

    public function actionGetByPrice() { 
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $params = Yii::$app->request->queryParams;

        $query = Price::find()
            ->leftJoin('products', 'products.id = price.product_id');

        if (isset($params['product_name'])){
            $query->where(['like', 'products.name', '%'.urldecode($params['product_name']).'%', false ]);
        }
        
        $query = $query->orderBy(['ultimo_precio_conocido' => SORT_DESC, 'price' => SORT_ASC])->limit(1000)->all();
            
        return ['items' => $query];    
    }
      
} 