<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Create category';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="my-4">
    <h1 class="mb-3">Add category</h1>

    <?php $form = ActiveForm::begin(['id' => 'category-form']); ?>
    <?= $form->field($category, 'name'); ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
