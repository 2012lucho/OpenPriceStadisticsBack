
<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
Hola <?= $user->username ?>,

Sigue el link para verificar tu email:

<a href="http://localhost:8100/confirm-email?id=<?php echo $user->id; ?>">Verificar email</a>