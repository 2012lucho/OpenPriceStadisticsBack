<?php
namespace app\actions;

use Yii;
use yii\rest\UpdateAction;
use yii\helpers\Url;
use app\models\User;
use app\models\Profile;

class ConfirmEmailAction extends UpdateAction {

    public function run($id) {
      $params = Yii::$app->getRequest()->getBodyParams();
      $user = User::find()->with('profile')->where(['id' => $id])->one();
      $profile = $user->profile;

      $response = Yii::$app->getResponse();
      $response->format = \yii\web\Response::FORMAT_JSON;
      try {
        if ($user){
            $user->verification_email = 1;

            $transaction = User::getDb()->beginTransaction();

            if ($user->save()){
              $transaction->commit();
              $response->data = [
                'id' => $user->id,
                'status' => true,
              ];
            } else{
              $transaction->rollBack();
              throw new \Exception($user->getErrors(), 1);
            }
          } else{
            $transaction->rollBack();
            throw new \Exception('El usuario no existe', 1);
          }
      } catch (\Exception $e) {
        $transaction->rollBack();
        $response->data = [
          'status' => false,
          'message' => $e->getMessage()
        ];
      }
    }

}