<?php

$this->title = 'Edit job ' . $job->title;

$jobTypes = [
    'full_time' => 'Full time',
    'part_time' => 'Part time',
    'as_needed' => 'As needed',
];

$salaries = [
    'Under $1000' => 'Under $1000',
    '$1000 - $2000' => '$1000 - $2000',
    '$2000 - $4000' => '$2000 - $4000',
    '$4000 - $6000' => '$4000 - $6000',
];

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="mt-4">
    <h1 class="mb-3">Edit job</h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($job, 'category_id')->dropDownList($categories, ['prompt' => 'Select Category']) ?>
    <?= $form->field($job, 'title') ?>
    <?= $form->field($job, 'description')->textarea(['rows' => 3]) ?>
    <?= $form->field($job, 'type')->dropDownList($jobTypes, ['prompt' => 'Select Type'])
    ?>
    <?= $form->field($job, 'requirements') ?>
    <?= $form->field($job, 'salary_range')->dropDownList($salaries, ['prompt' => 'Select salary range']) ?>
    <?= $form->field($job, 'city') ?>
    <?= $form->field($job, 'address') ?>
    <?= $form->field($job, 'contact_email') ?>
    <?= $form->field($job, 'contact_phone') ?>
    <?= $form->field($job, 'is_published')->radioList(['1' => 'Yes', '0' => 'No']) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- job-create -->