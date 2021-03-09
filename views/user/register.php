<?php

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="mt-4">
    <h1 class="mb-3">Register</h1>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($user, 'username') ?>
        <?= $form->field($user, 'email')->input('email') ?>
        <?= $form->field($user, 'password')->passwordInput() ?>
        <?= $form->field($user, 'password_repeat')->passwordInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
