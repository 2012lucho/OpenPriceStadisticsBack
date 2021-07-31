<?php
namespace app\actions;

use Yii;
use yii\rest\UpdateAction;
use yii\helpers\Url;
use app\models\User;

class ChangePasswordTokenAction extends UpdateAction {

    public function run($id) {
        $params = Yii::$app->getRequest()->getBodyParams();
        $token = isset($params['token']) ? $params['token'] : null;
        $new_password = isset($params['new_password']) ? $params['new_password'] : null;

        $response = Yii::$app->getResponse();
        $response->format = \yii\web\Response::FORMAT_JSON;
  
        if ($token && $new_password){
          $user = User::findByPasswordResetToken($token);
          $transaction = User::getDb()->beginTransaction();
          if($user){
              $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($new_password);
              $id = $user->id;
              if($user->save()){
                  $transaction->commit();
                  $response->data = [
                      'status' => true,
                      'id'   => $id
                  ];
              }else{
                  $transaction->rollBack();
                  $response->data = [
                      'status' => false,
                      'message' => 'Error no se pudo cambiar la contraseña!',
                  ];                   
              }
          }else{
              $transaction->rollBack();
              $response->data = [
                  'status' => false,
                  'message' => 'Error no se pudo cambiar la contraseña!',
              ];                   
          }
        }else{
          $response->data = [
              'status' => false,
              'message' => 'Error no se pudo cambiar la contraseña!',
          ];                   
      }
 }
}