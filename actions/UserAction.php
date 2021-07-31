<?php
namespace app\actions;

use Yii;
use yii\rest\CreateAction;
use yii\helpers\Url;
use app\models\User;
use app\models\Profile;

class UserAction extends CreateAction {

    public function run() {
      $params = Yii::$app->getRequest()->getBodyParams();
      $username = isset($params['username']) ? $params['username'] : null;

      $response = Yii::$app->getResponse();
      $response->format = \yii\web\Response::FORMAT_JSON;

      $stored = User::find()->where( ['username' => $username] )->one();
      if ($stored){
        $response->data = [
            'status' => false,
            'message' => 'The username already exists'
        ];
      } else{
        $role_id = isset($params['role_id']) ? $params['role_id'] : null;
        $password = isset($params['password']) ? $params['password'] : null;
        $user = new User();
        $user->username = $username;
        $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);

        $randomStr = Yii::$app->getSecurity()->generateRandomString();
        $user->access_token =  Yii::$app->getSecurity()->generatePasswordHash($password . $randomStr);
        $user->id = 0;
        $user->state_id = 1;
        $user->role_id = $role_id;
        $user->verification_email = 0;

        $profile = new Profile();
        $profile->id= 0;
        $birth_date = isset($params['birth_date']) ? $params['birth_date'] : null;
        $description = isset($params['description']) ? $params['description'] : null;
        $email = isset($params['email']) ? $params['email'] : null;
        $gender_id = isset($params['gender_id']) ? $params['gender_id'] : null;
        $gender_preference_id = isset($params['gender_preference_id']) ? $params['gender_preference_id'] : null;
        $default_profile_image_id = isset($params['default_profile_image_id']) ? $params['default_profile_image_id'] : null;
        $profile->birth_date = $birth_date;
        $profile->description = $description;
        $profile->email = $email;
        $profile->gender_id = $gender_id;
        $profile->gender_preference_id = $gender_preference_id;
        $profile->default_profile_image_id = $default_profile_image_id;
        $profile->lat = null;
        $profile->lng = null;

        $user->profile_id = $profile->id;

        $transaction = User::getDb()->beginTransaction();

        if ($profile->save()){
            $user->profile_id = $profile->id;
            if($user->save()){
              $transaction->commit();
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
                  'username' => $user->username,
                  'id' => $user->id,
                  'profile' => $profile->id,
                  'message' => 'Usuario Creado!'
              ];
            }else{
              $transaction->rollBack();
              $response->data = [
                'status' => false,
                'message' => 'Usuario no creado! Hay un error!'
              ];
            }
        } else{
          $transaction->rollBack();
          $response->data = [
            'status' => false,
            'message' => 'Usuario no creado! Hay un error!',
            'Error' => $user->getErrors()
          ];
        }

      }
  }
}
