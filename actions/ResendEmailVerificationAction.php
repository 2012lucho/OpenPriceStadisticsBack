<?php
namespace app\actions;

use Yii;
use yii\rest\UpdateAction;
use yii\helpers\Url;
use app\models\User;
use app\models\Profile;

class ResendEmailVerificationAction extends UpdateAction {

    public function run($id) {
        $params = Yii::$app->getRequest()->getBodyParams();
        $user = User::find()->with('profile')->where(['id' => $id])->one();
        $profile = $user->profile;

        $username = isset($params['username']) ? $params['username'] : null;

        $response = Yii::$app->getResponse();
        $response->format = \yii\web\Response::FORMAT_JSON;

        $email = $profile->email;

        if ($email){
            $message = Yii::$app
                  ->mailer
                  ->compose(
                      ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                      ['user' => $user]
                    )
                  ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                  ->setTo($email)
                  ->setSubject('Verificacion de email para ' . Yii::$app->name)
                  ->send();
              $response->data = [
                'status' => true,
                'send' => $message,
                'message' => 'Email enviado!',
               ];
            }
          else
            $response->data = [
                'status' => false,
                'message' => 'A ocurrido un error!',
            ];
        }
}
