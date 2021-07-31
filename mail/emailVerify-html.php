<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
<div class="password-reset">
    <p>Hola <?= Html::encode($user->username) ?>,</p>

    <p>Sigue el link para verificar tu email:</p>

    <a href="http://localhost:8100/confirm-email?id=<?php echo $user->id; ?>">Verificar email</a>
</div>