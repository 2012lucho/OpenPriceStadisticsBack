<?php
namespace app\actions;

use Yii;
use yii\rest\CreateAction;
use yii\helpers\Url;
use app\models\ProfileImage;
use yii\web\UploadedFile;
use app\models\User;

class CreateImageAction extends CreateAction {

    public function run() {
      $params  = Yii::$app->getRequest()->getBodyParams();

      $response = Yii::$app->getResponse();
      $response->format = \yii\web\Response::FORMAT_JSON;

      $profile_img = $_FILES['image'];
      if (isset($profile_img) && $profile_img != "") {
            $tipo   = $profile_img['type'];
            $tamano = $profile_img['size'];
            $temp   = $profile_img['tmp_name'];
            //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
            if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
              $response->data = [
                'success' => false,
                'message' => 'Error. La extensión o el tamaño de los archivos no es correcta.'
              ];
            } else {
              $date     = new \DateTime();
              $img_name = $date->getTimestamp().$profile_img['name'];
              //Si la imagen es correcta en tamaño y tipo
              //Se intenta subir al servidor
              $full_path = getcwd().'/user_data/'.$img_name;

              try {
                if (move_uploaded_file($temp, $full_path)) {
                  $profImgModel             = new ProfileImage();
                  $profImgModel->path       = $full_path;
                  $profImgModel->url        = '/user_data/'.$img_name;
                  $profImgModel->profile_id = $params['profile_id'];

                  if ( $profImgModel->save() ){
                    $response->data = [
                      'success' => true,
                      'id'      => $profImgModel->id,
                      'url'     => $profImgModel->url
                    ];
                  } else {
                    $response->data = [
                      'success' => false,
                      'message' => $profImgModel->getErrors()
                    ];
                  }

                }
              } catch (\Exception $e) {
                  $response->data = [
                    'success' => false,
                    'message' => $e
                  ];
              }

          }
       }

    }

}
