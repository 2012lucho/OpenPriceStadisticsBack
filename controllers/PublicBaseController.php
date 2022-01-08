<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\Cors;
use app\components\HttpTokenAuth;

use app\traits\Filterable;
use app\models\PublicInputHistory;
use app\models\PublicService;
use app\models\PublicServiceCuota;

class PublicBaseController extends ActiveController {

    use Filterable;

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items'
    ];

    // index: list resources page by page;
    // view: return the details of a specified resource;
    // create: create a new resource;
    // update: update an existing resource;
    // delete: delete the specified resource;
    // options: return the supported HTTP methods.
    public function actions(){
      $actions = parent::actions();
      $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
      return $actions;
    }

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

    public function prepareDataProvider(){
      $query = $this->modelClass::find();

      $query = $this->addFilterConditions($query);

      return new ActiveDataProvider([
        'query' => $query->orderBy(['id' => SORT_ASC]),
      ]);
    }

    public function beforeAction($event)
    {
      
      $controller = get_class($event);
      if ($controller == 'yii\rest\OptionsAction' || $controller == 'yii\rest\CreateAction' || $controller == 'yii\rest\IndexAction'){
        $controller = get_class($event->controller);
      }

      $controller = explode('\\', $controller);
      $controller = $controller[count($controller)-1];

      $ip = $this->get_client_ip();
      //si no se pudo obtener la IP se indica error de cuota de uso excedida
      if ($ip === 'UNKNOWN'){
        throw new \Exception('Cuota de uso excedida.');
      }

      //Se obtiene la cuota asignada a la funcionalidad
      $servicio = PublicService::find()->where(['controller' => $controller])->one();
      $cuota    = PublicServiceCuota::find()->where(['id_public_service' => $servicio->id])
                   ->joinWith('cuotaMeter')->all()[0]->getCuotaMeter()->primaryModel->getRelatedRecords()['cuotaMeter'];
  
    //se verifica que haya limnite de cuota, si no hay enteonce se continua sin registrar nada
      if ($cuota->amount == -1 && $cuota->time_lapse_seconds == -1){
        return parent::beforeAction($event);
      }

      $fechaHora  = new \DateTime();
      $fechaLimit = new \DateTime();
      $fechaLimit->modify('-'.$cuota->time_lapse_seconds.' second');
      $fechaHora  = $fechaHora->format('Y-m-d H:i:s');
      $fechaLimit = $fechaLimit->format('Y-m-d H:i:s');
      
      //Se consultan los registros contenidos dentro del lapso de tiempo definido
      //Se buscan todos los registros del historico correspondiente con la IP
      $historic = PublicInputHistory::find()
                  ->where(['client_ip4' => $ip])->andWhere(['>','datetime',$fechaLimit])->all();
      
      //se verifica que la cantidad no supere el limite
      if (count($historic) > $cuota->amount){
        throw new \Exception('Cuota de uso excedida.');
      }
      
      //Se registra el ingreso
      $ingreso = new PublicInputHistory();
      $ingreso->client_ip4        = $ip;
      $ingreso->client_ip6        = $ip; //[MODIFICAR] Luego
      $ingreso->cookie_session    = ' ';
      $ingreso->datetime          = $fechaHora;
      $ingreso->public_service_id = $servicio->id;
      if (!$ingreso->save(false)){
        throw new \Exception('Algo anda mal evidentemente.');
      }
        
        return parent::beforeAction($event);
    }

    private function regInput(){

    }

    public function get_client_ip() {
      $ipaddress = '';
      if (getenv('HTTP_CLIENT_IP'))
          $ipaddress = getenv('HTTP_CLIENT_IP');
      else if(getenv('HTTP_X_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
      else if(getenv('HTTP_X_FORWARDED'))
          $ipaddress = getenv('HTTP_X_FORWARDED');
      else if(getenv('HTTP_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_FORWARDED_FOR');
      else if(getenv('HTTP_FORWARDED'))
         $ipaddress = getenv('HTTP_FORWARDED');
      else if(getenv('REMOTE_ADDR'))
          $ipaddress = getenv('REMOTE_ADDR');
      else
          $ipaddress = 'UNKNOWN';
      return $ipaddress;
  }

    private function cuotaNotExceded(){
      return true;
    }
}
