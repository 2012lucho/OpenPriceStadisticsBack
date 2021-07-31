<?php
namespace app\actions;

use Yii;
use yii\rest\UpdateAction;
use yii\helpers\Url;
use app\models\User;
use app\models\Profile;

class UpdateUserAction extends UpdateAction {

    public function run($id) {
      $params = Yii::$app->getRequest()->getBodyParams();
      $user = User::find()->with('profile')->where(['id' => $id])->one();
      $profile = $user->profile;

      $username = isset($params['username']) ? $params['username'] : $user->username;
      $online = isset($params['online']) ? $params['online'] : $user->online;
      $role_id = isset($params['role_id']) ? $params['role_id'] : $user->role_id;
      $state_id = isset($params['state_id']) ? $params['state_id'] : $user->state_id;
      $password = isset($params['password']) ? $params['password'] : null;

      $birth_date = isset($params['birth_date']) ? $params['birth_date'] : $profile->birth_date;
      $description = isset($params['description']) ? $params['description'] : $profile->description;
      $email = isset($params['email']) ? $params['email'] : $profile->email;
      $gender_id = isset($params['gender_id']) ? $params['gender_id'] : $profile->gender_id;
      $gender_preference_id = isset($params['gender_preference_id']) ? $params['gender_preference_id'] : $profile->gender_preference_id;
      $default_profile_image_id = isset($params['default_profile_image_id']) ? $params['default_profile_image_id'] : $profile->default_profile_image_id;

      $response = Yii::$app->getResponse();
      $response->format = \yii\web\Response::FORMAT_JSON;
      try {
        if ($user && $profile){
            $user->username = $username;
            $user->role_id = $role_id;
            $user->state_id = $state_id;
            $user->online   = $online;

            $profile->birth_date = $birth_date;
            $profile->description = $description;
            $profile->email = $email;
            $profile->gender_id = $gender_id;
            $profile->gender_preference_id = $gender_preference_id;
            $profile->default_profile_image_id = $default_profile_image_id;

            if ($password != $user->password_hash)
              $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);

            $transaction = User::getDb()->beginTransaction();

            if ($user->save() && $profile->save()){
              $transaction->commit();
              $response->data = [
                'id' => $user->id,
                'profile' => $profile->id,
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
