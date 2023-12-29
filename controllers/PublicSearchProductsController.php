<?php 
namespace app\controllers; 

use Yii; 
use yii\web\Controller;
use yii\filters\Cors;
use yii\db\Expression;

use app\models\Price;
use app\models\Products;
use app\models\SearchQueryHistory;

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

    function comparar_precios($a, $b) {
        $fechaA = $a['price'];
        $fechaB = $b['price'];
    
        if ($fechaA == $fechaB) {
            return 0;
        }
    
        return ($fechaA < $fechaB) ? -1 : 1;
    }

    public function actionGetByPrice() { 
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $params = Yii::$app->request->queryParams;

        $salida = ['items' => []];

        $query_params = explode(" ",urldecode($params['product_name']));
        $products = Products::find();
        
        for ($i=0; $i < count($query_params); $i++) {
            $products = $products->andWhere(['like', 'products.name', '%'.$query_params[$i].'%', false ]);
        }
        
        $products = $products->all();

        $aux = [];

        $lastMonth = new \DateTime();
        $lastMonth->modify('-1 month');

        for ($i = 0; $i < count($products); $i++) {
            $prices = Price::find()
                ->where(['product_id' => $products[$i]->id])
                ->andWhere(['>', 'date_time', new Expression('DATE_SUB(NOW(), INTERVAL 1 MONTH)')])
                ->orderBy(['date_time' => SORT_DESC])
                ->all();


            $price_arr = [];
            $branch_dicc = [];
            for ($j=0; $j < count($prices); $j++) {
                if (isset($branch_dicc[$prices[$j]->branch->id])) {
                    continue;
                }

                $branch_dicc[$prices[$j]->branch->id] = true;
                $price_arr[] = [
                    'price' => $prices[$j]->price,
                    'date_time' => $prices[$j]->date_time,
                    'branch' => $prices[$j]->branch,
                    'branch_id' => $prices[$j]->branch->id
                ];
            }

            $aux[] = [
                'id' => $products[$i]->id,
                'name' => $products[$i]->name,
                'prices' => $price_arr
            ];
        }

        $aux2 = [];

        for ($i=0; $i < count($aux); $i++) {
            for ($j=0; $j < count($aux[$i]['prices']); $j++) {
                $reg = $aux[$i]['prices'][$j];
                $reg['products']['name'] = $aux[$i]['name'];
                $aux2[] = $reg;
            }
        }
        usort($aux2, [$this, 'comparar_precios']);

        $salida['items'] = $aux2;

        try {
            $history = new SearchQueryHistory();
            $history->query = $params['product_name'];
            $history->cant_results = count($salida['items']);
            $history->save(false);
        } catch (\Throwable $th) {
            //throw $th;
            $salida['errors'] = $th->getMessage();
        }

        return $salida;    
    }
      
} 