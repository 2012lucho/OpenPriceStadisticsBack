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

    function hacer_busqueda( $busqueda,  $where_type ){
        $query_params = explode(" ",urldecode($busqueda));

        if($where_type == "AND") {
            $products = Products::find();
            for ($i=0; $i < count($query_params); $i++) {
                $products = $products->andWhere(['like', 'products.name', '%'.$query_params[$i].'%', false ]);
            }
            $products = $products->all();
        }

        if ($where_type == "OR") {
            $sql = "SELECT * FROM products WHERE ";
            $params = [];
            
            $array_nuevo = [];
            for ($i=0; $i < count($query_params); $i++) {
                if (strlen($query_params[$i]) > 3)
                    $array_nuevo[] = $query_params[$i];
            }

            for ($i=0; $i < count($array_nuevo); $i++) {
                if ($i > 0) {
                    $sql .= 'XOR (products.name LIKE :p'.$i.' ) ';
                } else
                    $sql .= ' (products.name LIKE :p0 ) ';
                
                $params[":p".$i] = "%".$array_nuevo[$i]."%";
            }

            $sql .= " LIMIT 500";
            
            $products = Products::findBySql($sql, $params);
            $products = $products->all();
        }

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

        return $aux2;
    }

    function verificarUltimaLetra($cadena, $letra) {
        $ultimaLetra = substr($cadena, -1);
        return strtolower($ultimaLetra) === $letra;
    }

    function quitarUltimoCaracter($cadena) {
        return substr($cadena, 0, strlen($cadena) - 1);
    }

    public function actionGetByPrice() { 
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $params = Yii::$app->request->queryParams;

        $salida = ['items' => []];

        $query_inicial = $params['product_name'];

        $salida['items'] = $this->hacer_busqueda($params['product_name'], "AND");
        $cant_items_1 = count($salida['items']); 
        if (count($salida['items']) < 3) {

            $palabras = explode(" ",$params['product_name']);
            
            if (count($palabras) == 1 && $this->verificarUltimaLetra($params['product_name'], "s")) {

                $params['product_name'] = $this->quitarUltimoCaracter($params['product_name']);
                $salida['items'] = array_merge( $salida['items'], $this->hacer_busqueda($params['product_name'], "AND"));
            
            }            
        }

        try {
            $history = new SearchQueryHistory();
            $history->query = $query_inicial;
            $history->cant_results = $cant_items_1;
            $history->save(false);
        } catch (\Throwable $th) {
            //throw $th;
            $salida['errors'] = $th->getMessage();
        }

        return $salida;    
    }
      
} 