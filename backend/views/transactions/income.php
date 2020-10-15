<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var array $users
 */

$currentUser = Yii::$app->user->getIdentity();
?>

<div class="expense-form">

    <?php $form = ActiveForm::begin(); ?>

    <label>Сумма внесения</label>
    <div class="form-group"><?= Html::input('text', 'sum', '', ['class' => 'form-control']) ?></div>

    <?php if ($currentUser->role == 'admin') { ?>
        <label>У пользователя</label>
        <div class="form-group"><?= Html::dropDownList("toUserId","", $users, ['class' => 'form-control']) ?></div>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton('Внести', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
