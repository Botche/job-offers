<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form ActiveForm */
?>
<div class="category-create my-4">
    <h1 class="mb-3">Add category</h1>

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($category, 'name'); ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- category-create -->
